<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;

class ReceptPatientController extends Controller
{
    // Quản lý bệnh nhân, đón tiếp bệnh nhân
    public function patient()
    {
        $patients = Patient::all();
        return view('receptionist.patient.patient', compact('patients'));
    }

    public function patient_create()
    {
        return view('receptionist.patient.patient_create');
    }

    public function patient_store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'name' => 'required',
            'birthday' => 'required',
            'phone' => ['required', 'unique:users,phone','regex:/^(0|\+84)(\d{9})$/'],
            'email' => 'nullable|email|unique:users,email',
            'address' => 'required',
            'cccd' => 'required|max:20',
            'bhyt' => 'required|max:20',
            'blood_type' => 'required',
            'emergency_contact' => 'required',
            'emergency_contact_phone' => 'required',
        ]);

        //Tạo tài khoản cho bệnh nhân
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt(123456);
        $user->is_active = 1;
        $user->save();


        //Tạo thông tin bệnh nhân mới
        $patient = new Patient();
        $patient->fullname = $request->fullname;
        $patient->birthday = $request->birthday;
        $patient->gender = $request->gender;
        $patient->address = $request->address;
        $patient->user_id = $user->user_id;
        $patient->cccd = $request->cccd;
        $patient->bhyt = $request->bhyt;
        $patient->blood_type = $request->blood_type;
        $patient->allergies = $request->allergies;
        $patient->medical_history = $request->medical_history;
        $patient->dental_history = $request->dental_history;
        $patient->current_medications = $request->current_medications;
        $patient->emergency_contact = $request->emergency_contact;
        $patient->emergency_contact_phone = $request->emergency_contact_phone;
        $patient->emergency_contact_address = $request->emergency_contact_address;
        $patient->save();

        return redirect()->route('receptionist/patient')->with('success', 'Lưu thông tin bệnh nhân thành công');
    }

    public function patient_edit($patient_id)
    {
        $patient = Patient::where('patient_id', $patient_id)->first();
        $user = $patient->user;

        return view('receptionist.patient.patient_edit', compact('patient', 'user'));
    }

    public function patient_update(Request $request, $patient_id)
    {
        $patient = Patient::findOrFail($patient_id);

        $request->validate([
            'fullname' => 'required',
            'name' => 'required',
            'birthday' => 'required',
            'phone' => ['required', 'unique:users,phone,' . $patient->user_id . ',user_id','regex:/^(0|\+84)(\d{9})$/'],
            'email' => 'nullable|email|unique:users,email,' . $patient->user_id . ',user_id',
            'address' => 'required',
            'cccd' => 'required|max:20',
            'bhyt' => 'required|max:20',
            'blood_type' => 'required',
            'emergency_contact' => 'required',
            'emergency_contact_phone' => 'required',
        ]);

        $patient->fullname = $request->fullname;
        $patient->birthday = $request->birthday;
        $patient->gender = $request->gender;
        $patient->address = $request->address;
        $patient->cccd = $request->cccd;
        $patient->bhyt = $request->bhyt;
        $patient->blood_type = $request->blood_type;
        $patient->allergies = $request->allergies;
        $patient->medical_history = $request->medical_history;
        $patient->dental_history = $request->dental_history;
        $patient->current_medications = $request->current_medications;
        $patient->emergency_contact = $request->emergency_contact;
        $patient->emergency_contact_phone = $request->emergency_contact_phone;
        $patient->emergency_contact_address = $request->emergency_contact_address;
        $patient->save();

        $user = $patient->user;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('receptionist/patient')->with('success', 'Cập nhật thông tin bệnh nhân thành công');
    }

    public function patient_show($patient_id)
    {
        $patient = Patient::where('patient_id', $patient_id)->first();
        $user = $patient->user;

        return view('receptionist.patient.patient_show', ['user' => $user, 'patient' => $patient]);
    }
}
