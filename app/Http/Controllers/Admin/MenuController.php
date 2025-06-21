<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuss = Menu::all()->sortBy('menuid');
        return view('admin.menu.index', ['menuss' => $menuss]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menuparents = Menu::where('level', 1)->get();
        return view('admin.menu.create', ['menuparents' => $menuparents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        ]);
        $menu = $request->all();
        Menu::create($menu);
        return redirect()->route('admin/menu')->with('success', 'Thêm mới menu thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        $menuparent = Menu::where('menuid', $menu->parentid)->first();
        return view('admin.menu.show', ['menu' => $menu, 'menuparent' => $menuparent]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $menuparents = Menu::where('level', 1)->get();
        return view('admin.menu.edit', ['menu' => $menu, 'menuparents' => $menuparents]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu) {
        $request->validate([
        ]);

        $data = $request->all();
        $menu->update($data);

        return redirect()->route('admin/menu')->with('success', 'Cập nhật menu thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin/menu')->with('success', 'Xóa menu thành công');
    }
}
