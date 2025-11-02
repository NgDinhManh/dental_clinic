<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Appointment_service;
use App\Models\Medical_record;
use App\Models\Patient;
use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\DB;
use App\Models\Prescription;
use App\Models\Prescription_detail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class PatientController extends Controller
{

    public function patient_account(User $user)
    {
        return view('patient.account', ['user' => $user]);
    }

    public function patient_account_update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'phone' => ['required', 'unique:users,phone,' . $user->user_id . ',user_id','regex:/^(0|\+84)(\d{9})$/'],
            'email' => 'nullable|email|unique:users,email,' . $user->user_id . ',user_id',
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $imagePath = public_path('storage/images/avatar/' . $user->avatar);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $file = $request->file('avatar');
            $filename = 'avatar' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/avatar'), $filename);

            $data['avatar'] = $filename; // Lưu đường dẫn ảnh vào database
        }

        $user->update($data);

        return redirect()->route("patient/account", $user->user_id)->with('success', 'Cập nhật tải khoản thành công');
    }

    public function patient_profile(User $user)
    {
        $patient = $user->patient;
        return view('patient.profile', compact('patient', 'user'));
    }

    public function patient_profile_update(Request $request, User $user)
    {
        $patient = $user->patient;

        $request->validate([
            'fullname' => 'required',
            'gender' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'cccd' => 'required',
            'bhyt' => 'required',
            'blood_type' => '',
            'emergency_contact' => 'required',
            'emergency_contact_phone' => 'required',
        ]);

        $data = $request->all();
        $patient->update($data);
        return redirect()->route("patient/profile", $user->user_id)->with('success', 'Cập nhật thông tin hồ sơ thành công');
    }

    public function patient_change_password(User $user)
    {
        return view('change_password', compact('user'));
    }

    public function patient_change_password_update(Request $request, User $user)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ], [
            'old_password.required' => 'Mật khẩu cũ không được để trống',
            'password.required' => 'Mật khẩu mới không được để trống',
            'password.min:6' => 'Mật khẩu ít nhất 6 ký tự',
            'confirm_password.required' => 'Nhập lại mật khẩu mới không được để trống',
            'confirm_password.same:password' => 'Vui lòng nhập lại đúng mật khẩu'
        ]);

        $old_password = $request->old_password;
        $password = $request->password;
        $status = Hash::check($old_password, $user->password);
        if($status) {
            $user->password = bcrypt($password);
            $user->save();
            return back()->with('success', 'Đổi mật khẩu thành công');
        }
        else {
            return back()->with('error', 'Mật khẩu cũ sai');
        }

    }

    public function patient_appointment($user_id)
    {
        $appointments = Appointment::query()->where('patient_id', $user_id)->orderBy('created_at', 'desc')->paginate(5)->withQueryString();
        $appointment_services = Appointment_service::all();
        $services = Service::all();
        $medical_records = Medical_record::all();
        $user = User::findOrFail($user_id);
        return view('appointment_patient', compact('appointments', 'appointment_services', 'services', 'medical_records', 'user'));
    }

    public function patient_appointment_destroy($appointment_id)
    {
        $appointment = Appointment::find($appointment_id);
        if ($appointment) {
            $appointment->delete();
            return redirect()->back()->with('success', 'Xóa lịch hẹn thành công.');
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy lịch hẹn.');
        }
    }

    public function patient_medical_record($user_id)
    {
        $medical_records = Medical_record::query()->where('patient_id', $user_id)->orderBy('created_at', 'desc')->paginate(5)->withQueryString();
        $users = User::all(); //Lấy thông tin để hiển thị tên bác sĩ
        $user = User::findOrFail($user_id); //Lấy thông tin bệnh nhân
        $invoices = Invoice::all();
        return view('medical_record', compact('medical_records', 'users', 'user', 'invoices'));
    }

    public function patient_medical_record_detail($record_id)
    {
        $medical_record = Medical_record::where('record_id', $record_id)->first();
        if (!$medical_record) {
            return redirect()->route('patient/medical_record')->with('error', 'Không tìm thấy bệnh án');
        }
        $user = User::findOrFail($medical_record->patient_id);
        $patient = DB::table('patients')
            ->join('users', 'patients.user_id', '=', 'users.user_id')
            ->where('users.roleid', 4)
            ->where('users.user_id', $medical_record->patient_id)
            ->select('users.*', 'patients.*')
            ->first();
        $doctor = User::where('user_id', $medical_record->doctor_id)->first();
        $services = Service::all()->take(4);
        $prescription = Prescription::where('record_id', $record_id)->first();
        if (!$prescription) {
            return view('medical_record_detail', compact('medical_record', 'user', 'patient', 'doctor', 'services'))->with('error', 'Không tìm thấy đơn thuốc');
        }
        $prescriptions = Prescription_detail::where('prescription_id', $prescription->prescription_id)->get(); // Lấy danh sách thuốc theo bệnh án

        return view('medical_record_detail', compact('medical_record', 'user', 'patient', 'doctor', 'services', 'prescriptions'));
    }

    public function patient_invoice ($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        if (!$invoice) {
            return redirect()->route('patient/medical-record')->with('error', 'Không tìm thấy hóa đơn');
        }
        $medical_record = Medical_record::where('record_id', $invoice->record_id)->first();
        $user = User::findOrFail($medical_record->patient_id);
        $patient = User::where('user_id', $medical_record->patient_id)->first();
        $medical_record_services = DB::table('medical_record_services')
        ->join('services', 'medical_record_services.service_id', '=', 'services.service_id')
        ->where('medical_record_services.record_id', $invoice->record_id)
        ->select('services.service_name', 'services.price')
        ->distinct()
        ->get();

        return view('invoice', compact('invoice', 'user', 'medical_record_services', 'patient'));
    }

}
