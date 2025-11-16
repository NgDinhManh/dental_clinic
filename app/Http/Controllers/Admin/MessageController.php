<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all()->sortByDesc('created_at');
        return view('admin.message.index', compact('messages'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return view('admin.message.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function reply(Message $message)
    {
        return view('admin.message.reply', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $message->reply = $request->reply;
        $message->save();

        return redirect()->route('admin/message')->with('success', 'Phản hồi tin nhắn thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin/message')->with('success', 'Xóa tin nhắn thành công.');
    }
}
