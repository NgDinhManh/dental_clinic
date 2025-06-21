<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Appointment_service;
use App\Models\Service;
use App\Models\Medical_record;
use App\Models\Invoice;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReceptionistController extends Controller
{
    public function receptionist_profile($userid)
    {
        $user = User::where('userid', $userid)->first();

        return view('receptionist.profile', ['user' => $user]);
    }

    public function receptionist_update(Request $request, $userid)
    {
        $user = User::where('userid', $userid)->first();

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $imagePath = public_path('storage/images/' . $user->avatar);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $file = $request->file('avatar');
            $filename = 'avatar' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images'), $filename);

            $data['avatar'] = $filename; // Lưu đường dẫn ảnh vào database
        }

        $user->update($data);

        return redirect()->route('receptionist/profile', $user->userid)->with('success', 'Cập nhật hồ sơ thành công.');
    }

    public function receptionist_change_password($userid)
    {
        $user = User::findOrFail($userid);
        return view('receptionist.change_password', compact('user'));
    }

    public function receptionist_change_password_update(Request $request, $userid)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ], [
            'old_password.required' => 'Mật khẩu cũ không được để trống',
            'password.required' => 'Mật khẩu mới không được để trống',
            'password.min:6' => 'Mật khẩu ít nhất 6 ký tự',
            'confirm_password.required' => 'Nhập lại mật khẩu mới không được để trống',
            'confirm_password.same:password' => 'Vui lòng nhập lại đúng mật khẩu'
        ]);

        $user = User::findOrFail($userid);
        $old_password = $request->old_password;
        $password = $request->password;
        $status = Hash::check($old_password, $user->password);
        if($status) {
            $user->password = bcrypt($password);
            $user->save();
            return back()->with('success', 'Đổi mật khẩu thành công');
        }
        else {
            return back()->with('error', 'Mật khẩu cũ sai');
        }

    }
    
}
