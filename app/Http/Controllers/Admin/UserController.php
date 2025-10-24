<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get()->sortBy('user_id');
        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();

        $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'address' => 'required',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'avatar' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/avatar'), $filename);

            $user->avatar = $filename; // Lưu đường dẫn ảnh vào database
        }

        $user->name = $request->name;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->phone = $request->phone;
        $user->password = bcrypt('123456');
        $user->email = $request->email;
        $user->address = $request->address;
        $user->is_active = $request->is_active;
        $user->role_id = $request->role_id;
        $user->save();
        return redirect()->route('admin/user')->with('success', 'Thêm người dùng thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $rolename = Role::where('role_id', $user->role_id)->first()->rolename;
        return view('admin.user.show', ['user' => $user, 'rolename' => $rolename]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        $request->validate([
            'phone' => 'required',
            'name' => 'required',
        ]);

        if ($request->hasFile('avatar')) {
            $imagePath = public_path('storage/images/avatar/' . $user->avatar);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $file = $request->file('avatar');
            $filename = 'avatar' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/avatar'), $filename);

            $data['avatar'] = $filename; // Lưu đường dẫn ảnh vào database
        }

        $user->update($data);
        return redirect()->route('admin/user')->with('success', 'Cập nhật người dùng thành công');
    }

    public function reset_password(User $user)
    {
        // Cập nhật mật khẩu mới
        $user->password = bcrypt('123456');
        $user->save();
        return redirect()->route('admin/user')->with('success', 'Cập nhật mật khẩu thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $imagePath = public_path('storage/images/avatar' . $user->avatar);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $user->delete();
        return redirect()->route('admin/user')->with('success', 'Xóa người dùng thành công');
    }
}
