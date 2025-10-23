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
        $receptionists = Receptionist::all();
        return view('admin.receptionist.index', ['receptionists' => $receptionists]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role_id', 3)->whereDoesntHave('receptionist')->get();
        return view('admin.receptionist.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $receptionist = new Receptionist();

        $receptionist->receptionist_id = $request->receptionist_id;
        $receptionist->start_date = $request->start_date;
        $receptionist->shift = $request->shift;
        $receptionist->note = $request->note;

        $receptionist->save();
        return redirect()->route('admin/receptionist');
    }

    /**
     * Display the specified resource.
     */
    public function show(Receptionist $receptionist)
    {
        $user = User::find($receptionist->receptionist_id);
        return view('admin.receptionist.show', ['receptionist' => $receptionist, 'user' => $user]);
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
        $data = $request->all();

        $receptionist->update($data);
        return redirect()->route('admin/receptionist');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receptionist $receptionist)
    {
        $receptionist->delete();
        return redirect()->route('admin/receptionist');
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
