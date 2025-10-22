<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Appointment_service;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ReceptAppointmentController extends Controller
{
    // Quản lý lịch hẹn
    public function appointment()
    {
        $appointments = Appointment::all();
        $appointment_services = Appointment_service::all();
        $services = Service::all();
        $patients = DB::table('patients')
            ->join('users', 'patients.patient_id', '=', 'users.user_id')
            ->select('patients.*', 'users.fullname')
            ->get();

        return view('receptionist.appointment.appointment', compact('appointments', 'appointment_services', 'services', 'patients'));
    }

    public function appointment_create(Request $request)
    {
        $services = Service::all();
        $patients = DB::table('patients')
            ->join('users', 'patients.patient_id', '=', 'users.user_id')
            ->select('patients.*', 'users.fullname')
            ->get();

        if ($request->has('search_phone') && $request->search_phone != '') {
            $patient = DB::table('patients')
            ->join('users', 'patients.patient_id', '=', 'users.user_id')
            ->where('users.phone', $request->search_phone)
            ->where('users.is_active', 1)
            ->select('patients.*', 'users.*')
            ->first();
            dd($patient);
            dd(DB::table('users')->where('phone', $request->search_phone)->first());
            return view('receptionist.appointment.appointment_create', compact('patient', 'services'));
        }

        return view('receptionist.appointment.appointment_create', compact('services'));
    }

    public function appointment_store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'services' => 'required|array',
        ], [
            'patient_id.required' => 'Vui lòng chọn bệnh nhân',
            'patient_id.exists' => 'Bệnh nhân không tồn tại',
            'appointment_date.required' => 'Vui lòng chọn ngày hẹn',
            'appointment_time.required' => 'Vui lòng chọn giờ hẹn',
            'services.required' => 'Vui lòng chọn dịch vụ',
        ]);
        // Lưu lịch hẹn vào database
        $appointment = new Appointment();
        $appointment->patient_id = $request->patient_id;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->notes = $request->notes;
        $appointment->save();

        foreach ($request->services as $service_id) {
            $appointmentService = new Appointment_service();
            $appointmentService->appointment_id = $appointment->appointment_id;
            $appointmentService->service_id = $service_id;
            $appointmentService->save();
        }
        return redirect()->route('receptionist/appointment')->with('success', 'Đặt lịch hẹn thành công');
    }

    public function appointment_show($appoinment_id)
    {
        // Lấy thông tin lịch hẹn từ database
        $appointment = Appointment::findOrFail($appoinment_id);
        $appointment_services_service_id = Appointment_service::where('appointment_id', $appoinment_id)->pluck('service_id')->toArray();
        $services = Service::all();
        $patient = DB::table('patients')
            ->join('users', 'patients.patient_id', '=', 'users.user_id')
            ->where('patients.patient_id', $appointment->patient_id)
            ->select('patients.*', 'users.*')
            ->first();
        return view('receptionist.appointment.appointment_show', compact('appointment', 'appointment_services_service_id', 'services', 'patient'));
    }

    public function appointment_edit($appoinment_id)
    {
        // Lấy thông tin lịch hẹn từ database
        $appointment = Appointment::findOrFail($appoinment_id);
        $appointment_services_service_id = Appointment_service::where('appointment_id', $appoinment_id)->pluck('service_id')->toArray();
        $services = Service::all();
        $patient = DB::table('patients')
            ->join('users', 'patients.patient_id', '=', 'users.user_id')
            ->where('patients.patient_id', $appointment->patient_id)
            ->select('patients.*', 'users.*')
            ->first();
        return view('receptionist.appointment.appointment_edit', compact('appointment', 'appointment_services_service_id', 'services', 'patient'));
    }

    public function appointment_update(Request $request, $appointment_id)
    {
        // Cập nhật lịch hẹn trong database
        $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'services' => 'required|array',
        ], [
            'patient_id.required' => 'Vui lòng chọn bệnh nhân',
            'patient_id.exists' => 'Bệnh nhân không tồn tại',
            'appointment_date.required' => 'Vui lòng chọn ngày hẹn',
            'appointment_time.required' => 'Vui lòng chọn giờ hẹn',
            'services.required' => 'Vui lòng chọn dịch vụ',
        ]);

        $appointment = Appointment::findOrFail($appointment_id);
        $appointment->patient_id = $request->patient_id;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->notes = $request->notes;
        $appointment->save();

        // Xóa các dịch vụ cũ
        Appointment_service::where('appointment_id', $appointment_id)->delete();
        // Thêm các dịch vụ mới
        foreach ($request->services as $service_id) {
            $appointmentService = new Appointment_service();
            $appointmentService->appointment_id = $appointment_id;
            $appointmentService->service_id = $service_id;
            $appointmentService->save();
        }
        return redirect()->route('receptionist/appointment')->with('success', 'Cập nhật lịch hẹn thành công');
    }
}
