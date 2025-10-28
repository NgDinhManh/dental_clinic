@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/category-service/store') }}" method="POST" class="card" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h4 class="page-title">Thêm danh mục dịch vụ</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="category_name" class="fs-5 form-label">Tên danh mục</label>
                    <input type="text" class="form-control form-control-lg" id="category_name" name="category_name"
                        required>
                </div>
                <div class="form-group">
                    <label for="description" class="fs-5 form-label">Mô tả</label>
                    <textarea class="form-control form-control-lg" id="description" name="description" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="status" class="fs-5 form-label">Trạng thái</label>
                    <select class="form-select form-control-lg" id="status" name="status">
                        <option value="Có sẵn">Có sẵn</option>
                        <option value="Tạm ngưng">Tạm ngưng</option>
                    </select>
                </div>
            </div>
            <div class="card-action p-3 text-center">
                <a class="btn btn-warning mx-2" href="{{ url()->previous() }}">
                    <i class="fa fa-arrow-left pe-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save pe-2"></i>Lưu</button>
            </div>
        </form>
    </div>
@endsection
