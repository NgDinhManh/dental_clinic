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
        $user = User::FindOrFail($request->userid);
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
            $lastUser = User::latest('userid')->first();
            $patient->userid = $lastUser->userid;
            
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
            $patient = Patient::FindOrFail($request->userid);

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

    public function patient_edit($userid)
    {
        $user = User::where('userid', $userid)->first();
        $patient = Patient::where('userid', $userid)->first();

        return view('receptionist.patient.patient_edit', compact('user', 'patient'));
    }

    public function patient_update(Request $request, $userid)
    {
        $user = User::findOrFail($userid);
        $user->name = $request->name;
        $user->fullname = $request->fullname;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->save();

        $patient = Patient::findOrFail($userid);
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

    public function patient_show($userid)
    {
        $user = User::where('userid', $userid)->first();
        $patient = Patient::where('userid', $userid)->first();

        return view('receptionist.patient.patient_show', ['user' => $user, 'patient' => $patient]);
    }
}
