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
        $users = User::all();
        return view('receptionist.patient.patient', ['patients' => $patients, 'users' => $users]);
    }

    public function patient_create(Request $request)
    {
        $users = User::all();

        if ($request->has('search_phone') && $request->search_phone != '') {
            $user = $users->where('phone', $request->search_phone)->first();
            return view('receptionist.patient.patient_create', compact('user'));
        }

        return view('receptionist.patient.patient_create');
    }

    public function patient_store(Request $request)
    {
        $user = User::FindOrFail($request->user_id);
        if (empty($user)) {
            //Tạo tài khoản cho bệnh nhân
            $user = new User();
            $user->name = $request->name;
            $user->fullname = $request->fullname;
            $user->birthday = $request->birthday;
            $user->gender = $request->gender;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = bcrypt(123456);
            $user->address = $request->address;
            $user->is_active = 1;
            $user->save();


            //Tạo thông tin bệnh nhân mới
            $patient = new Patient();
            $lastUser = User::latest('user_id')->first();
            $patient->user_id = $lastUser->user_id;

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
        }
        else {
            $patient = Patient::FindOrFail($request->user_id);

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
        }

        return redirect()->route('receptionist/patient')->with('success', 'Lưu thông tin bệnh nhân thành công');
    }

    public function patient_edit($user_id)
    {
        $user = User::where('user_id', $user_id)->first();
        $patient = Patient::where('user_id', $user_id)->first();

        return view('receptionist.patient.patient_edit', compact('user', 'patient'));
    }

    public function patient_update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->name = $request->name;
        $user->fullname = $request->fullname;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->save();

        $patient = Patient::findOrFail($user_id);
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

        return redirect()->route('receptionist/patient')->with('success', 'Cập nhật thông tin bệnh nhân thành công');
    }

    public function patient_show($user_id)
    {
        $user = User::where('user_id', $user_id)->first();
        $patient = Patient::where('patient_id', $user_id)->first();

        return view('receptionist.patient.patient_show', ['user' => $user, 'patient' => $patient]);
    }
}
