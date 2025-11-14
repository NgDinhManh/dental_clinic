<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Medical_record;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BenhNhanController extends Controller
{
    public function benh_nhan_tung_kham()
    {
        $doctor = Auth::user()->doctor; // Lấy bác sĩ đang đăng nhập
        $patients = Patient::join('medical_records', 'patients.patient_id', '=', 'medical_records.patient_id')
            ->where('medical_records.doctor_id', $doctor->doctor_id)
            ->select('patients.*')
            ->distinct()
            ->get(); // Lấy danh sách bệnh nhân đã khám

        return view('doctor.benh-nhan.benh-nhan', compact('patients'));
    }

    public function benh_nhan()
    {
        $patients = Patient::all(); // Lấy danh sách bệnh nhân
        return view('doctor.benh-nhan.benh-nhan', compact('patients'));
    }

    public function benh_nhan_benh_an($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $medical_records = $patient->medical_records;
        return view('doctor.benh-nhan.benh-nhan-benh-an', compact('patient', 'medical_records'));
    }

    public function benh_nhan_show($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        return view('doctor.benh-nhan.benh-nhan-show', compact('patient'));
    }
}
