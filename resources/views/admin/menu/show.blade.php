@extends('layouts.admin');

@section('content')
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h4>Chi tiết Menu</h4>
            </div>
            <div class="card-body row">
                <div class="form-group col-md-6">
                    <label class="fs-5">Mã menu</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $menu->menu_id }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Tên Menu</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $menu->menu_name }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Cấp độ</label>
                    <input type="text" class="form-control form-control-lg" value="{{$menu->level}}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Menu cha</label>
                    <input type="text" class="form-control form-control-lg" value="{{$menu->parent_id == 0 ? '---' : $menuparent->menu_name}}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Route Name</label>
                    <input type="text" class="form-control form-control-lg" name="route_name"
                        value="{{ $menu->route_name }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Thứ tự</label>
                    <input type="text" class="form-control form-control-lg" name="menu_order"
                        value="{{ $menu->menu_order }}">
                </div>

                <div class="form-check col-md-6">
                    <label class="fs-5">Trạng thái</label>
                    <input type="text" class="form-control form-control-lg" value="{{$menu->is_active == 1 ? 'Hiển thị' : 'Ẩn'}}">
                </div>
            </div>

            <div class="card-action mt-4 p-3 text-center">
                <a class="btn btn-warning w-auto" href="{{route('admin/menu')}}"><i class="fa fa-arrow-left pe-2"></i>Trở về</a>
            </div>
        </div>
    </div>
@endsection
