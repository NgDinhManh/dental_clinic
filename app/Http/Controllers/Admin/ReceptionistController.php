<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Medical_record;
use Illuminate\Support\Facades\DB;

class ReceptionistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receptionists = Receptionist::all()->sortByDesc('created_at');
        return view('admin.receptionist.index', ['receptionists' => $receptionists]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.receptionist.create');
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
            'start_date' => 'required|date',
            'shift' => 'required',
        ]);

        $data = $request->all();

        // Tạo tài khoản cho tiếp tân
        User::create([
            'name' => $request->fullname,
            'phone' => $request->phone,
            'password' => bcrypt('123456'),
            'role_id' => 3,
        ]);

        $data['user_id'] = User::where('phone', $request->phone)->first()->user_id;

        Receptionist::create($data);
        return redirect()->route('admin/receptionist')->with('success', 'Thêm tiếp tân thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Receptionist $receptionist)
    {
        return view('admin.receptionist.show', ['receptionist' => $receptionist]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receptionist $receptionist)
    {
        $user = User::find($receptionist->receptionist_id);
        return view('admin.receptionist.edit', ['receptionist' => $receptionist, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receptionist $receptionist)
    {
        $request->validate([
            'fullname' => 'required',
            'gender' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'phone' => ['required', 'unique:users,phone,' . $receptionist->user_id . ',user_id','regex:/^(0|\+84)(\d{9})$/'],
            'start_date' => 'required|date',
            'shift' => 'required',
        ]);

        $data = $request->all();

        $user = $receptionist->user;
        $user->phone = $data['phone'];
        $user->save();

        $receptionist->update($data);
        return redirect()->route('admin/receptionist')->with('success', 'Cập nhật tiếp tân thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receptionist $receptionist)
    {
        $user = $receptionist->user;
        $receptionist->delete();
        $user->delete();
        return redirect()->route('admin/receptionist')->with('success', 'Xóa tiếp tân thành công');
    }

    public function invoice()
    {
        $invoices = DB::table('invoices')
        ->join('medical_records', 'invoices.record_id', '=', 'medical_records.record_id')
        ->join('users', 'medical_records.patient_id', '=', 'users.user_id')
        ->select('invoices.*', 'medical_records.created_at as checkup_date', 'users.fullname')
        ->distinct()
        ->get();

        $medical_record_services = DB::table('medical_record_services')
        ->join('services', 'medical_record_services.service_id', '=', 'services.service_id')
        ->select('medical_record_services.*', 'services.service_name')
        ->distinct()
        ->get();
        return view('admin.receptionist.invoice', compact('invoices', 'medical_record_services'));
    }

    public function invoice_show($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $medical_record = Medical_record::where('record_id', $invoice->record_id)->first();
        $patient = User::where('user_id', $medical_record->patient_id)->first();
        $medical_record_services = DB::table('medical_record_services')
        ->join('services', 'medical_record_services.service_id', '=', 'services.service_id')
        ->where('medical_record_services.record_id', $invoice->record_id)
        ->select('services.service_name', 'services.price')
        ->distinct()
        ->get();
        return view('admin.receptionist.invoice-show', compact('invoice', 'medical_record', 'patient', 'medical_record_services'));
    }

    public function invoice_reopen(Request $request, $invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        $invoice->status = 'Chưa thanh toán';
        $invoice->save();

        $notification = new Notification();
        $notification->receiver_id = $invoice->receptionist_id;
        $notification->title = 'Chấp nhận yêu cầu mở lại hóa đơn';
        $notification->content = 'Yêu cầu mở lại hóa đơn ' . $invoice->invoice_id . ' của bệnh nhân ' . $invoice->medical_record->patient->user->fullname . ' đã được xác nhận!';
        $notification->save();

        return back()->with('success', 'Đã chấp nhận mở lại hóa đơn');
    }

    public function invoice_decline(Request $request, $invoice_id)
    {
        $invoice = Invoice::find($invoice_id);

        $notification = new Notification();
        $notification->receiver_id = $invoice->receptionist_id;
        $notification->title = 'Hủy yêu cầu mở lại hóa đơn';
        $notification->content = 'Yêu cầu mở lại hóa đơn ' . $invoice->invoice_id . ' của bệnh nhân ' . $invoice->medical_record->patient->user->fullname . ' đã bị từ chối!';
        $notification->save();

        return back()->with('success', 'Đã từ chối mở lại hóa đơn');
    }
}
