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
        $doctor = $user = Auth::user(); // Lấy bác sĩ đang đăng nhập
        $patients = DB::table('patients')
            ->join('medical_records', 'patients.userid', '=', 'medical_records.patient_id')
            ->where('medical_records.doctor_id', $doctor->userid)
            ->select('patients.*')
            ->distinct('patients.userid') // Lấy danh sách bệnh nhân đã khám
            ->get();
        $medical_records = Medical_record::select('record_id', 'patient_id')->get();
        return view('doctor.benh-nhan.benh-nhan', compact('patients', 'medical_records'));
    }

    public function benh_nhan()
    {
        $patients = Patient::all(); // Lấy danh sách bệnh nhân
        $medical_records = Medical_record::select('record_id', 'patient_id')->get();
        return view('doctor.benh-nhan.benh-nhan', compact('patients', 'medical_records'));
    }

    public function benh_nhan_benh_an($patient_id)
    {
        $patient = Patient::where('userid', $patient_id)->first();
        $medical_records = Medical_record::where('patient_id', $patient_id)->get();
        return view('doctor.benh-nhan.benh-nhan-benh-an', compact('patient', 'medical_records'));
    }

    public function benh_nhan_show($patient_id)
    {
        $patient = DB::table('patients')
            ->join('users', 'patients.userid', '=', 'users.userid')
            ->where('users.roleid', 4)
            ->where('users.userid', $patient_id)
            ->select('users.*', 'patients.*')
            ->first();
        return view('doctor.benh-nhan.benh-nhan-show', compact('patient'));
    }
}
