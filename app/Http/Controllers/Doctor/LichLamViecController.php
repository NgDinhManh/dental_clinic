<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Appointment_service;
use App\Models\Service;
use App\Models\User;
use App\Models\Medical_record;
use App\Models\Medical_record_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class LichLamViecController extends Controller
{
    public function lich_kham_hom_nay()
    {
        $today = date('Y-m-d');
        $appointments = Appointment::where('appointment_date', $today)->get();
        $appointment_services = Appointment_service::all();
        $services = Service::all();
        $patients = User::where('roleid', 4)->get(); // Lấy danh sách bệnh nhân
        return view('doctor.lich-lam-viec.lich-kham-hom-nay', compact('appointments', 'appointment_services', 'services', 'patients'))->with('success', 'Đăng nhập thành công!');
    }

    public function lich_kham_tuan_nay()
    {
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');

        $appointments = Appointment::whereBetween('appointment_date', [$startOfWeek, $endOfWeek])->get();
        $services = Service::all();
        $patients = User::where('roleid', 4)->get(); // Lấy danh sách bệnh nhân
        return view('doctor.lich-lam-viec.lich-kham', compact('appointments', 'services', 'patients'));
    }

    public function lich_kham()
    {
        $appointments = Appointment::all();
        $appointment_services = Appointment_service::all();
        $services = Service::all();
        $patients = User::where('roleid', 4)->get(); // Lấy danh sách bệnh nhân
        return view('doctor.lich-lam-viec.lich-kham', compact('appointments', 'appointment_services', 'services', 'patients'));
    }

    public function kham_benh_lich($appointment_id)
    {
        $appointment = Appointment::where('appointment_id', $appointment_id)->first();

        $services = Service::all();

        $patient = DB::table('patients')
            ->join('users', 'patients.userid', '=', 'users.userid')
            ->where('users.roleid', 4)
            ->where('users.userid', $appointment->patient_id)
            ->select('users.*', 'patients.*')
            ->first();
            session(['previous_url' => url()->previous()]);
        return view('doctor.lich-lam-viec.kham-benh', compact('appointment', 'services', 'patient'));
    }

    public function kham_benh_lich_store(Request $request)
    {
        // Lưu thông tin bệnh án
        $medical_record = new Medical_record();
        $medical_record->patient_id = $request->patient_id;
        $medical_record->doctor_id = $request->doctor_id;
        $medical_record->appointment_id = $request->appointment_id;
        $medical_record->symptoms = $request->symptoms;
        $medical_record->diagnosis = $request->diagnosis;
        $medical_record->treatment_plan =  $request->treatment_plan;
        $medical_record->notes =  $request->notes;
        $medical_record->save();

        // Lưu thông tin dịch vụ
        if (empty($request->services)) {
            return redirect()->back()->with('error', 'Vui lòng chọn dịch vụ');
        }
        foreach ($request->services as $service) {
            $medical_record_services = new Medical_record_service();
            $medical_record_services->record_id = $medical_record->record_id;
            $medical_record_services->service_id = $service;
            $medical_record_services->save();
        }

        //Cập nhật trạng thái lịch hẹn
        $appointment = Appointment::find($request->appointment_id);
        $appointment->status = 'Đã khám'; // Đã khám
        $appointment->save();

        return redirect(session('previous_url', route('doctor/lich-lam-viec/lich-kham')))->with('success', 'Đã lưu thông tin bệnh án thành công!');
    }

    public function kham_benh_lich_huy($appointment_id)
    {
        $appointment = Appointment::where('appointment_id', $appointment_id)->first();
        $appointment->status = 'Đã hủy'; // Đã hủy
        $appointment->save();

        $notification = new Notification();
        $notification->receiver_id = $appointment->patient_id;
        $notification->title = 'Lịch khám của bạn đã bị hủy';
        $notification->content = 'Lịch khám ' . $appointment_id . ' của bệnh nhân ' . $appointment->patient->user->fullname . ' đã bị hủy.';
        $notification->save();

        return redirect()->back()->with('success', 'Đã hủy lịch hẹn thành công!');
    }
}
