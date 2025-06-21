<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all()->sortBy('faq_id');
        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $faq = new Faq();
        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');
        $faq->is_active = $request->input('is_active');
        $faq->sort_order = $request->input('sort_order');
        $faq->save();

        return redirect()->route('admin/faq')->with('success', 'Thêm câu hỏi thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        // Hiển thị thông tin chi tiết của câu hỏi
        return view('admin.faq.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        // Hiển thị form chỉnh sửa thông tin câu hỏi
        return view('admin.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');
        $faq->is_active = $request->input('is_active');
        $faq->sort_order = $request->input('sort_order');
        $faq->save();

        return redirect()->route('admin/faq')->with('success', 'Cập nhật câu hỏi thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin/faq')->with('success', 'Xóa câu hỏi thành công.');
    }
}
