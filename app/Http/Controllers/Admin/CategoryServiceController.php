<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category_service;
use Illuminate\Http\Request;

class CategoryServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_services = Category_service::all();
        return view('admin.category-service.index', compact('category_services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category-service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category_service = new Category_service();
        $category_service->category_name = $request->category_name;
        $category_service->description = $request->description;
        $category_service->status = $request->status;
        $category_service->save();

        return redirect()->route('admin/category-service')->with('success', 'Thêm danh mục dịch vụ thành công');
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category_service $category_service)
    {
        return view('admin.category-service.show', compact('category_service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category_service $category_service)
    {
        return view('admin.category-service.edit', compact('category_service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category_service $category_service)
    {
        $category_service->category_name = $request->category_name;
        $category_service->description = $request->description;
        $category_service->status = $request->status;
        $category_service->save();

        return redirect()->route('admin/category-service')->with('success', 'Cập nhật danh mục dịch vụ thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category_service $category_service)
    {
        if($category_service->services()->count() > 0) {
            $category_service->status = 'Tạm ngưng';
            $category_service->save();
            return redirect()->route('admin/category-service')->with('error', 'Danh mục chuyển sang trạng thái tạm ngưng vì đã có dịch vụ thuộc danh mục này');
        }
        $category_service->delete();

        return redirect()->route('admin/category-service')->with('success', 'Xóa danh mục dịch vụ thành công');
    }
}
