<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        $category_services = Category_service::all();
        return view('admin.service.index', compact('services', 'category_services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $post_services = Post::where('topic', 'Dịch vụ')->get();
        $category_services = Category_service::all();
        return view('admin.service.create', compact('post_services', 'category_services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'image' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/services'), $filename);

            $data['image'] = $filename; // Lưu đường dẫn ảnh chứng chỉ vào database
        }

        Service::create($data);
        return redirect()->route('admin/service')->with('success', 'Thêm dịch vụ thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $category_services = Category_service::all();
        return view('admin.service.show', compact('service', 'category_services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $post_services = Post::where('topic', 'Dịch vụ')->get();
        $category_services = Category_service::all();
        return view('admin.service.edit', compact('service', 'post_services', 'category_services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $data = $request->all();

        // Lưu ảnh mới nếu có
        if ($request->hasFile('image')) {
            $imagePath = public_path('storage/images/services' . $service->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $file = $request->file('image');
            $filename = 'image' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/images/services'), $filename);

            $data['image'] = $filename; // Lưu đường dẫn ảnh vào database
        }

        $service->update($data);
        return redirect()->route('admin/service')->with('success', 'Cập nhật dịch vụ thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin/service')->with('success', 'Xóa dịch vụ thành công');
    }
}
