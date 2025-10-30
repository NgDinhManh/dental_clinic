<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Receptionist;
use App\Models\Medical_record;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthContronller extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function check_register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ], [
            'min:6' => 'Mật khẩu ít nhất 6 ký tự',
            'same:password' => 'Vui lòng nhập lại đúng mật khẩu'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->role_id = 4; // Mặc định là Bệnh nhân đăng ký tài khoản

        $user->save();

        $patient = new Patient();
        $patient->user_id = $user->user_id;
        $patient->save();

        return redirect()->route('login');
    }

    public function login()
    {
        return view('login');
    }

    public function check_login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required|min:4',
        ]);

        $phone = $request->phone;
        $password = $request->password;
        $status = Auth::attempt(['phone' => $phone, 'password' => $password]);

        if ($status) {
            $user = Auth::user();
            if (!$user->is_active) {
                return back()->with('msg', 'Tài khoản bị khóa, vui lòng liên hệ quản trị viên!');
            } else if ($user->role_id == 1) {
                return redirect()->route('admin/index');
            } else if ($user->role_id == 2) {
                return redirect()->route('doctor/index');
            } else if ($user->role_id == 3) {
                return redirect()->route('receptionist/index');
            } else {
                return redirect()->route('/');
            }
            return;
        } else {
            return back()->with('msg', 'Email hoặc mật khẩu không đúng!');
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/'); // Chuyển hướng về trang chủ
    }

    public function admin_index(Request $request)
    {
        $total_user = User::where('role_id', 4)->count();
        // $total_patient = User::whereIn('user_id', Medical_record::pluck('patient_id'))->count();
        $total_patient = Patient::count();
        $total_doctor = User::where('role_id', 2)->count();
        $total_medical_record = Medical_record::count();
        $new_users = User::where('role_id', 4)->orderBy('created_at', 'desc')->take(6)->get();
        $new_medical_records = Medical_record::orderBy('created_at', 'desc')->take(8)->get();

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
                ->where('status', 'Đã thanh toán') // Chỉ lấy hóa đơn đã thanh toán
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

        return view('admin.index', compact('total_user', 'total_patient', 'total_doctor', 'total_medical_record', 'new_users', 'new_medical_records', 'labels', 'data', 'selectedYear', 'selectedMonth'));
    }

    public function doctor_index()
    {
        return view('doctor.index');
    }

    public function recep_index()
    {
        return view('receptionist.index');
    }
}
