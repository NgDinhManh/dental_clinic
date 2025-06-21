<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Medical_record;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceptInvoiceController extends Controller
{
    // Quản lý hóa đơn
    public function invoice()
    {
        $invoices = DB::table('invoices')
        ->join('medical_records', 'invoices.record_id', '=', 'medical_records.record_id')
        ->join('users', 'medical_records.patient_id', '=', 'users.userid')
        ->select('invoices.*', 'medical_records.created_at as checkup_date', 'users.fullname')
        ->distinct()
        ->get();

        $medical_record_services = DB::table('medical_record_services')
        ->join('services', 'medical_record_services.service_id', '=', 'services.service_id')
        ->select('medical_record_services.*', 'services.service_name')
        ->distinct()
        ->get();

        return view('receptionist.invoice.invoice', compact('invoices', 'medical_record_services'));
    }

    public function invoice_show($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $medical_record = Medical_record::where('record_id', $invoice->record_id)->first();
        $patient = User::where('userid', $medical_record->patient_id)->first();
        $medical_record_services = DB::table('medical_record_services')
        ->join('services', 'medical_record_services.service_id', '=', 'services.service_id')
        ->where('medical_record_services.record_id', $invoice->record_id)
        ->select('services.service_name', 'services.price')
        ->distinct()
        ->get();

        return view('receptionist.invoice.invoice-show', compact('invoice', 'medical_record_services', 'patient'));
    }

    public function invoice_print($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $medical_record = Medical_record::where('record_id', $invoice->record_id)->first();
        $patient = User::where('userid', $medical_record->patient_id)->first();
        $medical_record_services = DB::table('medical_record_services')
        ->join('services', 'medical_record_services.service_id', '=', 'services.service_id')
        ->where('medical_record_services.record_id', $invoice->record_id)
        ->select('services.service_name', 'services.price')
        ->distinct()
        ->get();

        return view('receptionist.invoice.invoice-print', compact('invoice', 'medical_record_services', 'patient'));
    }

    public function invoice_reload()
    {   
        $invoices_record_id = Invoice::pluck('record_id')->toArray();
        $medical_records = Medical_record::where('status', 'Hoàn tất')
        ->whereNotIn('record_id', $invoices_record_id)->get();

        if ($medical_records->isEmpty()) {
            return redirect()->route('receptionist/invoice')->with('error', 'Không có hóa đơn mới.');
        }
        else {
            foreach ($medical_records as $medical_record) {
                $invoice = new Invoice();
                $invoice->record_id = $medical_record->record_id;
                $invoice->receptionist_id = Auth::user()->userid;

                $total_price = DB::table('medical_record_services')
                ->join('services', 'medical_record_services.service_id', '=', 'services.service_id')
                ->where('medical_record_services.record_id', $medical_record->record_id)
                ->select(DB::raw('SUM(services.price) as total_price'))
                ->first();
                $total_price = (float) $total_price->total_price; // Ép kiểu float
                
                $invoice->total_amount = $total_price; // Hoặc giá trị mặc định khác
                $invoice->save();
            }
        }

        $invoices = DB::table('invoices')
        ->join('medical_records', 'invoices.record_id', '=', 'medical_records.record_id')
        ->join('users', 'medical_records.patient_id', '=', 'users.userid')
        ->select('invoices.*', 'medical_records.created_at as checkup_date', 'users.fullname')
        ->distinct()
        ->get();

        $medical_record_services = DB::table('medical_record_services')
        ->join('services', 'medical_record_services.service_id', '=', 'services.service_id')
        ->select('medical_record_services.*', 'services.service_name')
        ->distinct()
        ->get();

        return redirect()->route('receptionist/invoice')->with('success', 'Cập nhật thêm ' . $medical_records->count() . ' hóa đơn thành công.');
    }

    public function invoice_edit($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $medical_record = Medical_record::where('record_id', $invoice->record_id)->first();
        $patient = User::where('userid', $medical_record->patient_id)->first();
        $medical_record_services = DB::table('medical_record_services')
        ->join('services', 'medical_record_services.service_id', '=', 'services.service_id')
        ->where('medical_record_services.record_id', $invoice->record_id)
        ->select('services.service_name', 'services.price')
        ->distinct()
        ->get();

        return view('receptionist.invoice.invoice-edit', compact('invoice', 'medical_record', 'patient', 'medical_record_services'));
    }

    public function invoice_update(Request $request, $invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $invoice->discount = $request->discount;
        $invoice->other_fee = $request->other_fee;
        $invoice->other_fee_detail = $request->other_fee_detail;
        $invoice->final_amount = $request->final_amount;
        $invoice->payment_method = $request->payment_method;
        $invoice->save();
        return redirect()->route('receptionist/invoice')->with('success', 'Cập nhật hóa đơn thành công');
    }

    public function invoice_pay($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $invoice->status = 'Đã thanh toán';
        $invoice->save();
        return back()->with('success', 'Thanh toán hóa đơn thành công');
    }

    public function invoice_cancel($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $invoice->status = 'Đã hủy';
        $invoice->save();
        return back()->with('success', 'Hủy hóa đơn thành công');
    }

    public function invoice_reopen($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $notification = new Notification();
        $notification->receiver_id = User::where('roleid', 1)->first()->userid;
        $notification->title = 'Yêu cầu mở lại hóa đơn';
        $notification->content = $invoice->receptionist->user->fullname . ' yêu cầu mở lại hóa đơn ' . $invoice->invoice_id . ' của bệnh nhân ' . $invoice->medical_record->patient->user->fullname;
        $notification->save();

        $notification = new Notification();
        $notification->receiver_id = $invoice->receptionist_id;
        $notification->title = 'Yêu cầu mở lại hóa đơn';
        $notification->content = 'Yêu cầu mở lại hóa đơn ' . $invoice->invoice_id . ' của bệnh nhân ' . $invoice->medical_record->patient->user->fullname . ' đã được gửi đến quản trị viên!';
        $notification->save();

        return back()->with('success', 'Gửi yêu cầu thành công. Vui lòng chờ xác nhận từ quản trị viên!');
    }
}
