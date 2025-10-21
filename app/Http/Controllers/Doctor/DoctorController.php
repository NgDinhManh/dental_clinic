<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function doctor_profile($user_id)
    {
        $user = User::where('user_id', $user_id)->first();

        return view('doctor.profile', ['user' => $user]);
    }

    public function doctor_update(Request $request, $user_id)
    {
        $user = User::where('user_id', $user_id)->first();

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

        return redirect()->route("doctor/profile", $user->user_id);
    }

    public function doctor_change_password($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('doctor.change_password', compact('user'));
    }

    public function doctor_change_password_update(Request $request, $user_id)
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

        $user = User::findOrFail($user_id);
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
