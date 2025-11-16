<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;


class NotificationController extends Controller
{
    public function index()
    {
        $notificationss = Notification::all();
        return view('admin.notification.index', compact('notificationss'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.notification.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'receiver_id' => 'required|exists:users,user_id',
            'title' => 'required|max:250',
            'content' => 'required',
        ]);

        Notification::create($data);

        return redirect()->route('admin/notification')->with('success', 'Tạo thông báo thành công');
    }

    public function show(Notification $notification)
    {
        return view('admin.notification.show', compact('notification'));
    }

    public function edit(Notification $notification)
    {
        $users = User::all();
        return view('admin.notification.edit', compact('notification', 'users'));
    }

    public function update(Request $request, Notification $notification)
    {
        $data = $request->validate([
            'receiver_id' => 'required|exists:users,user_id',
            'title' => 'required|max:250',
            'content' => 'required',
        ]);

        $notification->update($data);
        return redirect()->route('admin/notification')->with('success', 'Cập nhật thông báo thành công');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('admin/notification')->with('success', 'Xóa thông báo thành công');
    }

    public function sendNotification($receiver_id, $title, $content)
    {
        Notification::create([
            'receiver_id' => $receiver_id,
            'title' => $title,
            'content' => $content,
        ]);
    }

    public function markAsRead(Notification $notification)
    {
        $notification->is_read = 1;
        $notification->save();

        return back();
    }

    public function markAsDeleted(Notification $notification)
    {
        $notification->is_deleted = 1;
        $notification->save();

        return back();
    }

    public function notificationDetail($id)
    {
        $notification = Notification::findOrFail($id);

        if (!$notification->is_read) {
            $notification->update(['is_read' => 1]);
        }

        return response()->json([
            'title' => $notification->title,
            'content' => $notification->content,
            'created_at' => $notification->created_at->toDateTimeString(),
        ]);
    }
}
