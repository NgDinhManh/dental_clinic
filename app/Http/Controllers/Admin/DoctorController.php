<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Medical_record;
use App\Models\Prescription;
use App\Models\Prescription_detail;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all()->sortByDesc('created_at');
        return view('admin.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'gender' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'phone' => ['required', 'unique:users,phone', 'regex:/^(0|\+84)(\d{9})$/'],
            'specialization' => 'required',
            'experience_years' => 'required|integer',
            'education' => 'required',
            'certification' => 'sometimes|image',
            'license' => 'sometimes|image',
        ]);

        $data = $request->all();

        // Tạo tài khoản cho bác sĩ
        User::create([
            'name' => $request->fullname,
            'phone' => $request->phone,
            'password' => bcrypt('123456'),
            'role_id' => 2,
        ]);

        $data['user_id'] = User::where('phone', $request->phone)->first()->user_id;

        if ($request->hasFile('certification')) {
            $file = $request->file('certification');
            $filename = 'image' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/doctor'), $filename);

            $data['certification'] = $filename; // Lưu đường dẫn ảnh chứng chỉ vào database
        }

        if ($request->hasFile('license')) {
            $file = $request->file('license');
            $filename = 'image' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/doctor'), $filename);

            $data['license'] = $filename; // Lưu đường dẫn ảnh chứng chỉ vào database
        }

        Doctor::create($data);

        return redirect()->route('admin/doctor')->with('success', 'Thêm bác sĩ thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $user = User::find($doctor->doctor_id);
        return view('admin.doctor.show', ['doctor' => $doctor, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $user = User::find($doctor->doctor_id);
        return view('admin.doctor.edit', ['doctor' => $doctor, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
       $request->validate([
            'fullname' => 'required',
            'gender' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'phone' => ['required', 'unique:users,phone,' . $doctor->user_id . ',user_id','regex:/^(0|\+84)(\d{9})$/'],
            'specialization' => 'required',
            'experience_years' => 'required|integer',
            'education' => 'required',
            'certification' => 'sometimes|image',
            'license' => 'sometimes|image',
        ]);

        $data = $request->all();

        // Lưu ảnh chứng chỉ
        if ($request->hasFile('certification')) {
            $imagePath = public_path('storage/images/doctor/' . $doctor->certification);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $file = $request->file('certification');
            $filename = 'image' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/doctor'), $filename);

            $data['certification'] = $filename; // Lưu đường dẫn ảnh vào database
        }

        // Lưu ảnh giấy phép
        if ($request->hasFile('license')) {
            $imagePath = public_path('storage/images/doctor/' . $doctor->license);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $file = $request->file('license');
            $filename = 'image' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/doctor'), $filename);

            $data['license'] = $filename; // Lưu đường dẫn ảnh vào database
        }

        $user = $doctor->user;
        $user->phone = $data['phone'];
        $user->save();

        $doctor->update($data);
        return redirect()->route('admin/doctor')->with('success', 'Cập nhật bác sĩ thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        // Xóa ảnh chứng chỉ
        $imagePath = public_path('storage/images/doctor/' . $doctor->certification);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Xóa ảnh giấy phép
        $imagePath = public_path('storage/images/doctor/' . $doctor->license);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $user = $doctor->user;
        $doctor->delete();
        $user->delete();
        return redirect()->route('admin/doctor')->with('success', 'Xóa bác sĩ thành công');
    }

    public function benh_an()
    {
        $medical_records = Medical_record::all(); // Lấy danh sách bệnh án
        $patients = User::where('role_id', 4)->get(); // Lấy danh sách bệnh nhân
        $doctors = User::where('role_id', 2)->get(); // Lấy danh sách bác sĩ
        $prescriptions = Prescription::all(); // Lấy danh sách đơn thuốc
        return view('admin.doctor.benh-an', compact('medical_records', 'patients', 'doctors', 'prescriptions'));
    }

    public function benh_an_show($record_id)
    {
        $medical_record = Medical_record::where('record_id', $record_id)->first();
        if (!$medical_record) {
            return redirect()->back()->with('error', 'Không tìm thấy bệnh án');
        }
        $patient = DB::table('patients')
            ->join('users', 'patients.patient_id', '=', 'users.user_id')
            ->where('users.role_id', 4)
            ->where('users.user_id', $medical_record->patient_id)
            ->select('users.*', 'patients.*')
            ->first();
        $doctor = User::where('doctor_id', $medical_record->doctor_id)->first();
        $services = Service::all()->take(4);
        $prescription = Prescription::where('record_id', $record_id)->first();
        if (!$prescription) {
            return view('doctor.benh-an.benh-an-show', compact('medical_record', 'patient', 'doctor', 'services', 'prescription'))->with('error', 'Không tìm thấy đơn thuốc');
        }
        $prescription_details = Prescription_detail::where('prescription_id', $prescription->prescription_id)->get(); // Lấy danh sách thuốc theo bệnh án
        return view('admin.doctor.benh-an-show', compact('medical_record', 'patient', 'doctor', 'services', 'prescription', 'prescription_details'));
    }

    public function benh_an_reopen($record_id)
    {
        $medical_record = Medical_record::where('record_id', $record_id)->first();
        $medical_record->status = 'Đang điều trị';
        $medical_record->save();

        $notification = new Notification();
        $notification->receiver_id = $medical_record->doctor_id;
        $notification->title = 'Chấp nhận mở lại bệnh án';
        $notification->content = 'Bệnh án ' . $medical_record->record_id . ' của bệnh nhân ' . $medical_record->patient->user->fullname . ' đã được chấp nhận mở lại';
        $notification->save();

        return redirect()->route('admin/doctor/benh-an')->with('success', 'Bệnh án đã được mở lại');
    }

    public function benh_an_decline($record_id)
    {
        $medical_record = Medical_record::where('record_id', $record_id)->first();

        $notification = new Notification();
        $notification->receiver_id = $medical_record->doctor_id;
        $notification->title = 'Từ chối mở lại bệnh án';
        $notification->content = 'Bệnh án ' . $medical_record->record_id . ' của bệnh nhân ' . $medical_record->patient->user->fullname . ' đã bị từ chối.';
        $notification->save();

        return redirect()->route('admin/doctor/benh-an')->with('success', 'Bệnh án đã bị từ chối');
    }
}
