@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/menu/store') }}" method="post" class="card">
            @csrf

            <div class="card-header">
                <h4 class="card-title">Thêm Menu</h4>
            </div>

            <div class="row card-body">
                <div class="form-group col-md-6">
                    <label class="fs-5">Tên Menu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg" name="menu_name">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Cấp độ <span class="text-danger">*</span></label>
                    <select class="form-select form-control-lg" name="level">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Menu cha</label>
                    <select class="form-select form-control-lg" name="parentid">
                        <option value="0">---</option>
                        @foreach ($menuparents as $menuparent)
                            <option value="{{ $menuparent->menu_id }}">{{ $menuparent->menu_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Route Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg" name="route_name">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Thứ tự <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg" name="menu_order">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Trạng thái <span class="text-danger">*</span></label>
                    <select name="is_active" id="is_active" class="form-select form-control-lg">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
            </div>

            <div class="card-action mt-4 p-3 text-center">
                <a class="btn btn-warning mx-2" href="{{route('admin/menu')}}"><i class="fa fa-arrow-left pe-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save pe-2"></i>Lưu</button>
            </div>

        </form>
    </div>
@endsection
