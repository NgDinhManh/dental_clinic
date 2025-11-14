<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Models\Medical_record;
use App\Models\Medical_record_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Prescription;
use App\Models\Prescription_detail;
use App\Models\Notification;

class BenhAnController extends Controller
{
    public function benh_an()
    {
        $medical_records = Medical_record::all(); // Lấy danh sách bệnh án
        $patients = User::where('role_id', 4)->get(); // Lấy danh sách bệnh nhân
        $doctors = User::where('role_id', 2)->get(); // Lấy danh sách bác sĩ
        $prescriptions = Prescription::all(); // Lấy danh sách đơn thuốc
        return view('doctor.benh-an.benh-an', compact('medical_records', 'patients', 'doctors', 'prescriptions'));
    }

    public function benh_an_show($record_id)
    {
        $medical_record = Medical_record::findOrFail($record_id);
        if (!$medical_record) {
            return redirect()->back()->with('error', 'Không tìm thấy bệnh án');
        }
        $patient = $medical_record->patient;
        $doctor = $medical_record->doctor;
        $prescription = Prescription::where('record_id', $record_id)->first();
        if (!$prescription) {
            return view('doctor.benh-an.benh-an-show', compact('medical_record', 'patient', 'doctor'));
        }
        $prescription_details = Prescription_detail::where('prescription_id', $prescription->prescription_id)->get(); // Lấy danh sách thuốc theo bệnh án
        return view('doctor.benh-an.benh-an-show', compact('medical_record', 'patient', 'doctor', 'prescription', 'prescription_details'));
    }

    public function benh_an_print($record_id)
    {
        $medical_record = Medical_record::findOrFail($record_id);
        if (!$medical_record) {
            return redirect()->route('doctor/benh-an/benh-an')->with('error', 'Không tìm thấy bệnh án');
        }
        $patient = $medical_record->patient;
        $doctor = $medical_record->doctor;
        $prescription = Prescription::where('record_id', $record_id)->first();
        if (!$prescription) {
            return view('doctor.benh-an.benh-an-print', compact('medical_record', 'patient', 'doctor'));
        }
        $prescription_details = Prescription_detail::where('prescription_id', $prescription->prescription_id)->get(); // Lấy danh sách thuốc theo bệnh án
        return view('doctor.benh-an.benh-an-print', compact('medical_record', 'patient', 'doctor', 'prescription', 'prescription_details'));
    }

    public function benh_an_edit($record_id)
    {
        $services = Service::all();
        $medical_record = Medical_record::findOrFail($record_id);
        if (!$medical_record) {
            return redirect()->route('doctor/benh-an/benh-an')->with('error', 'Không tìm thấy bệnh án');
        }

        $medical_record_services = $medical_record->medical_record_services->pluck('service_id')->toArray();
        if (!$medical_record_services) {
            return redirect()->route('doctor/benh-an/benh-an')->with('error', 'Không tìm thấy dịch vụ');
        }

        $patient = $medical_record->patient;
        if (!$patient) {
            return redirect()->route('doctor/benh-an/benh-an')->with('error', 'Không tìm thấy bệnh nhân');
        }

        session(['previous_url' => url()->previous()]);
        return view('doctor.benh-an.benh-an-edit', compact('medical_record', 'medical_record_services', 'patient', 'services'));
    }

    public function benh_an_update(Request $request, $record_id)
    {
        $request->validate([
            'symptoms' => 'required',
            'diagnosis' => 'required',
            'services' => 'required|array',
            'services.*' => 'integer|exists:services,service_id',
            'treatment_plan' => 'required',
        ]);

        $medical_record = Medical_record::findOrFail($record_id);
        $medical_record->symptoms = $request->symptoms;
        $medical_record->diagnosis = $request->diagnosis;
        $medical_record->treatment_plan = $request->treatment_plan;
        $medical_record->notes = $request->notes;
        $medical_record->save();

        // Báo chọn dịch vụ
        if (empty($request->services)) {
            return redirect()->back()->with('error', 'Vui lòng chọn dịch vụ');
        }
        // Xóa các dịch vụ cũ
        $medical_record_services = Medical_record_service::where('record_id', $record_id)->delete();

        // Lưu thông tin dịch vụ mới
        foreach ($request->services as $service) {
            $medical_record_services = new Medical_record_service();
            $medical_record_services->record_id = $medical_record->record_id;
            $medical_record_services->service_id = $service;
            $medical_record_services->save();
        }

        return redirect(session('previous_url', route('doctor/benh-an/benh-an')))->with('success', 'Cập nhật thông tin bệnh án thành công!');
    }

    public function hoan_tat_benh_an($record_id)
    {
        $medical_record = Medical_record::where('record_id', $record_id)->first();
        $medical_record->status = 'Hoàn tất';
        $medical_record->save();
        return redirect()->back()->with('success', 'Hoàn tất bệnh án thành công!');
    }

    public function benh_an_dang_dieu_tri()
    {
        $medical_records = Medical_record::where('status', 'Đang điều trị')->get(); // Lấy danh sách bệnh án
        $patients = User::where('role_id', 4)->get(); // Lấy danh sách bệnh nhân
        $doctors = User::where('role_id', 2)->get(); // Lấy danh sách bác sĩ
        $prescriptions = Prescription::all(); // Lấy danh sách đơn thuốc
        session(['previous_url' => url()->previous()]);
        return view('doctor.benh-an.benh-an', compact('medical_records', 'patients', 'doctors', 'prescriptions'));
    }

    public function benh_an_hoan_tat()
    {
        $medical_records = Medical_record::where('status', 'Hoàn tất')->get(); // Lấy danh sách bệnh án
        $patients = User::where('role_id', 4)->get(); // Lấy danh sách bệnh nhân
        $doctors = User::where('role_id', 2)->get(); // Lấy danh sách bác sĩ
        $prescriptions = Prescription::all(); // Lấy danh sách đơn thuốc
        session(['previous_url' => url()->previous()]);
        return view('doctor.benh-an.benh-an', compact('medical_records', 'patients', 'doctors', 'prescriptions'));
    }

    public function benh_an_reopen($record_id)
    {
        $medical_record = Medical_record::where('record_id', $record_id)->first();

        $notification = new Notification();
        $notification->receiver_id = User::where('role_id', 1)->first()->user_id;
        $notification->title = 'Yêu cầu mở lại bệnh án';
        $notification->content = 'Yêu cầu mở lại bệnh án ' . $medical_record->record_id . ' của bệnh nhân ' . $medical_record->patient->user->fullname;
        $notification->save();

        $notification = new Notification();
        $notification->receiver_id = Auth::user()->user_id;
        $notification->title = 'Yêu cầu mở lại bệnh án';
        $notification->content = 'Bệnh án ' . $medical_record->record_id . ' của bệnh nhân ' . $medical_record->patient->user->fullname . ' đã được yêu cầu mở lại. Vui lòng chờ!';
        $notification->save();

        return redirect()->route('doctor/benh-an/benh-an')->with('success', 'Đã gửi yêu cầu mở lại bệnh án');
    }
}
