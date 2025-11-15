<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function statistic_service(Request $request)
    {
        $year = $request->input('year', now()->year);
        $month = $request->input('month');

        $query = DB::table('medical_record_services')
            ->join('services', 'medical_record_services.service_id', '=', 'services.service_id')
            ->join('medical_records', 'medical_record_services.record_id', '=', 'medical_records.record_id')
            ->where('medical_records.status', 'Hoàn tất')
            ->select('services.service_name', DB::raw('COUNT(*) as usage_count'))
            ->whereYear('medical_record_services.created_at', $year);

        if ($month) {
            $query->whereMonth('medical_record_services.created_at', $month);
        }

        $results = $query->groupBy('services.service_name')
            ->orderByDesc('usage_count')
            ->get();

        $labels = $results->pluck('service_name');
        $data = $results->pluck('usage_count');
        $selectedYear = $year;
        $selectedMonth = $month;

        return view('admin.statistic.service', compact('labels', 'data', 'selectedYear', 'selectedMonth'));
    }

    public function statistic_revenue(Request $request)
    {
        $year = $request->input('year', now()->year);
        $month = $request->input('month'); // null nếu không chọn

        if ($month) {
            // Thống kê theo ngày trong tháng
            $results = DB::table('invoices')
                ->where('status', 'Đã thanh toán') // Chỉ lấy hóa đơn đã thanh toán
                ->selectRaw('DAY(updated_at) as label, SUM(final_amount) as total')
                ->whereYear('updated_at', $year)
                ->whereMonth('updated_at', $month)
                ->groupByRaw('DAY(updated_at)')
                ->orderByRaw('DAY(updated_at)')
                ->get();
        } else {
            // Thống kê theo tháng trong năm
            $results = DB::table('invoices')
                ->selectRaw('MONTH(updated_at) as label, SUM(final_amount) as total')
                ->whereYear('updated_at', $year)
                ->groupByRaw('MONTH(updated_at)')
                ->orderByRaw('MONTH(updated_at)')
                ->get();
        }

        $labels = $results->pluck('label')->map(function ($val) use ($month) {
            return $month ? "Ngày $val" : "Tháng $val";
        });

        $data = $results->pluck('total');
        $selectedYear = $year;
        $selectedMonth = $month;
        $invoices = Invoice::orderBy('updated_at', 'desc')->take(10)->get();

        $medical_record_services = $invoices;

        return view('admin.statistic.revenue', compact('labels', 'data', 'selectedYear', 'selectedMonth', 'invoices', 'medical_record_services'));
    }

}
