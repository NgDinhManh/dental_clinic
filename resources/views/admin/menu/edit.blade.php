@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/menu/update', $menu->menu_id) }}" method="post" class="card">
            @csrf @method('put')
            <div class="card-header">
                <h4 class="card-title">Sửa Menu</h4>
            </div>

            <div class="row card-body">
                <div class="form-group col-md-6">
                    <label class="fs-5">Tên Menu</label>
                    <input type="text" class="form-control form-control-lg" name="menu_name" value="{{$menu->menu_name}}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Cấp độ</label>
                    <select class="form-select form-control-lg" name="level">
                        <option value="1" {{$menu->level == 1 ? 'selected' : ''}}>1</option>
                        <option value="2" {{$menu->level == 2 ? 'selected' : ''}}>2</option>
                        <option value="3" {{$menu->level == 3 ? 'selected' : ''}}>3</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Menu cha</label>
                    <select class="form-select form-control-lg" name="parent_id">
                        <option value="0" {{ ($menu->parent_id == 0) ? 'selected' : '' }}>---</option>
                        @foreach ($menuparents as $menuparent)
                            <option value="{{ $menuparent->menu_id }}" {{ ($menu->parent_id == $menuparent->menu_id) ? 'selected' : '' }}>
                                {{ $menuparent->menu_name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Route Name</label>
                    <input type="text" class="form-control form-control-lg" name="route_name" value="{{$menu->route_name}}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Thứ tự</label>
                    <input type="text" class="form-control form-control-lg" name="menu_order" value="{{$menu->menu_order}}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Trạng thái</label>
                    <select name="is_active" id="is_active" class="form-select form-control-lg">
                        <option value="1" {{$menu->is_active == 1 ? 'selected' : ''}}>Hiển thị</option>
                        <option value="0" {{$menu->is_active == 0 ? 'selected' : ''}}>Ẩn</option>
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
