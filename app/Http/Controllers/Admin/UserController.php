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
        $users = User::all()->sortByDesc('created_at');
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
        $request->validate([
            'name' => 'required',
            'phone' => ['required', 'unique:users,phone','regex:/^(0|\+84)(\d{9})$/'],
            'email' => 'nullable|email|unique:users,email',
        ],
        [
            'name.required' => 'Tên người dùng không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt('123456');

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'avatar' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/avatar'), $filename);

            $data['avatar'] = $filename; // Lưu đường dẫn ảnh vào database
        }

        User::create($data);
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
        $request->validate([
            'name' => 'required',
            'phone' => ['required', 'unique:users,phone,' . $user->user_id . ',user_id','regex:/^(0|\+84)(\d{9})$/'],
            'email' => 'nullable|email|unique:users,email,' . $user->user_id . ',user_id',
        ],
        [
            'name.required' => 'Tên người dùng không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $imagePath = public_path('storage/images/avatar/' . $user->avatar);
            if (File::exists($imagePath) && $user->avatar != 'avatar_default.png') {
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
        // Cài lại mật khẩu
        $user->password = bcrypt('123456');
        $user->save();
        return redirect()->route('admin/user')->with('success', 'Mật khẩu mới là: 123456');
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
