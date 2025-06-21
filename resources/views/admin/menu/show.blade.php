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
                    <input type="text" class="form-control form-control-lg" value="{{ $menu->menuid }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Tên Menu</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $menu->menuname }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Cấp độ</label>
                    <input type="text" class="form-control form-control-lg" value="{{$menu->level}}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Menu cha</label>
                    <input type="text" class="form-control form-control-lg" value="{{$menu->parentid == 0 ? '---' : $menuparent->menuname}}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Route Name</label>
                    <input type="text" class="form-control form-control-lg" name="routename"
                        value="{{ $menu->routename }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Thứ tự</label>
                    <input type="text" class="form-control form-control-lg" name="menuorder"
                        value="{{ $menu->menuorder }}">
                </div>

                <div class="form-check col-md-6">
                    <label class="fs-5">Trạng thái</label>
                    <input type="text" class="form-control form-control-lg" value="{{$menu->isactive == 1 ? 'Hiển thị' : 'Ẩn'}}">
                </div>

                <div class="col-12">
                    <a class="btn btn-warning fs-5 w-auto" href="{{route('admin/menu')}}"><i class="fa fa-arrow-left mx-2"></i>Trở về</a>
                </div>
            </div>
        </div>
    </div>
@endsection
