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
                    <label class="fs-5">Tên Menu</label>
                    <input type="text" class="form-control form-control-lg" name="menuname" required>
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Cấp độ</label>
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
                            <option value="{{ $menuparent->menuid }}">{{ $menuparent->menuname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Route Name</label>
                    <input type="text" class="form-control form-control-lg" name="routename" required>
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Thứ tự</label>
                    <input type="text" class="form-control form-control-lg" name="menuorder" required>
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Trạng thái</label>
                    <select name="isactive" id="isactive" class="form-select form-control-lg">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>

                <div class="row">
                    <a class="btn btn-warning fs-5 col-2 mx-2" href="{{route('admin/menu')}}"><i class="fa fa-arrow-left mx-2"></i>Trở về</a>
                    <button type="submit" class="btn btn-success fs-5 col-2"><i class="fa fa-save mx-2"></i>Lưu</button>
                </div>
            </div>

        </form>
    </div>
@endsection
