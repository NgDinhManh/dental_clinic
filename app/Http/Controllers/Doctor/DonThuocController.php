<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Medical_record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prescription;
use App\Models\Prescription_detail;

class DonThuocController extends Controller
{
    public function don_thuoc()
    {
        $medical_records = Medical_record::all(); // Lấy danh sách bệnh án
        $prescriptions = Prescription::all(); // Lấy danh sách đơn thuốc
        $patients = User::where('roleid', 4)->get(); // Lấy danh sách bệnh nhân
        $doctors = User::where('roleid', 2)->get(); // Lấy danh sách bác sĩ
        session(['previous_url' => url()->previous()]);
        return view('doctor.don-thuoc.don-thuoc', compact('medical_records', 'prescriptions', 'patients', 'doctors'));
    }

    public function don_thuoc_create($record_id)
    {
        $medical_record = Medical_record::where('record_id', $record_id)->first();
        if (!$medical_record) {
            return redirect()->route('doctor/benh-an/benh-an')->with('error', 'Không tìm thấy bệnh án');
        }
        $patient = DB::table('patients')
        ->join('users', 'patients.userid', '=', 'users.userid')
        ->where('users.userid', $medical_record->patient_id)
        ->select('users.*', 'patients.*')
        ->first();
        if (!$patient) {
            return redirect()->back()->with('error', 'Không tìm thấy bệnh nhân');
        }
        return view('doctor.don-thuoc.don-thuoc-create', compact('patient', 'medical_record'));
    }

    public function don_thuoc_store(Request $request)
    {
        // Lưu thông tin đơn thuốc
        $prescription = new Prescription();
        $prescription->record_id = $request->record_id;
        $prescription->doctor_id = $request->doctor_id;
        $prescription->notes = $request->notes;
        $prescription->save();

        // Lưu thông tin chi tiết đơn thuốc
        foreach ($request->input('medicines', []) as $med) {
            Prescription_detail::create([
                'prescription_id' => $prescription->prescription_id,
                'medicine_name' => $med['medicine_name'],
                'dosage' => $med['dosage'],
                'quantity' => $med['quantity'],
                'instruction' => $med['instruction'],
            ]);
        }

        return redirect(session('previous_url', route('doctor/benh-an/benh-an')))->with('success', 'Tạo đơn thuốc thành công!');
    }

    public function don_thuoc_edit($record_id)
    {
        $medical_record = Medical_record::where('record_id', $record_id)->first();
        if (!$medical_record) {
            return redirect()->back()->with('error', 'Không tìm thấy bệnh án');
        }
        $prescription = Prescription::where('record_id', $record_id)->first();
        if (!$prescription) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn thuốc');
        }
        $prescription_details = Prescription_detail::where('prescription_id', $prescription->prescription_id)->get();
        $patient = DB::table('patients')
        ->join('users', 'patients.userid', '=', 'users.userid')
        ->where('users.userid', $medical_record->patient_id)
        ->select('users.*', 'patients.*')
        ->first();
        if (!$patient) {
            return redirect()->back()->with('error', 'Không tìm thấy bệnh nhân');
        }
        session(['previous_url' => url()->previous()]);
        return view('doctor.don-thuoc.don-thuoc-edit', compact('prescription', 'prescription_details', 'medical_record', 'patient'));
    }

    public function don_thuoc_update(Request $request, $record_id)
    {
        $prescription = Prescription::where('record_id', $record_id)->first();
        if (!$prescription) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn thuốc');
        }

        // Cập nhật thông tin đơn thuốc
        $prescription->doctor_id = $request->doctor_id;
        $prescription->notes = $request->notes;
        $prescription->save();

        $prescription_details = Prescription_detail::where('prescription_id', $prescription->prescription_id)->get();
        foreach ($prescription_details as $detail) {
            $detail->delete();
        }

        // Lưu thông tin chi tiết đơn thuốc
        foreach ($request->input('medicines', []) as $med) {
            Prescription_detail::create([
                'prescription_id' => $prescription->prescription_id,
                'medicine_name' => $med['medicine_name'],
                'dosage' => $med['dosage'],
                'quantity' => $med['quantity'],
                'instruction' => $med['instruction'],
            ]);
        }

        return redirect(session('previous_url', route('doctor/benh-an/benh-an')))->with('success', 'Cập nhật thông tin đơn thuốc thành công!');
    }

    public function don_thuoc_show($record_id)
    {
        $medical_record = Medical_record::where('record_id', $record_id)->first();
        if (!$medical_record) {
            return redirect()->back()->with('error', 'Không tìm thấy bệnh án');
        }
        $prescription = Prescription::where('record_id', $record_id)->first();
        if (!$prescription) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn thuốc');
        }
        $prescription_details = Prescription_detail::where('prescription_id', $prescription->prescription_id)->get();
        $patient = DB::table('patients')
        ->join('users', 'patients.userid', '=', 'users.userid')
        ->where('users.userid', $medical_record->patient_id)
        ->select('users.*', 'patients.*')
        ->first();
        if (!$patient) {
            return redirect()->back()->with('error', 'Không tìm thấy bệnh nhân');
        }
        return view('doctor.don-thuoc.don-thuoc-show', compact('prescription', 'prescription_details', 'medical_record', 'patient'));
    }
}
