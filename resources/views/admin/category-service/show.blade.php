@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h4>Chỉnh sửa danh mục dịch vụ</h4>
            </div>

            <div class="card-body">
                <div class="mb-3 fs-5">
                    <label for="category_name" class="form-label fs-5">Tên danh mục</label>
                    <input type="text" class="form-control form-control-lg" id="category_name" name="category_name" rows="8" value="{{ $category_service->category_name }}" required>
                </div>
                <div class="mb-3 fs-5">
                    <label for="description" class="form-label fs-5">Mô tả</label>
                    <textarea class="form-control form-control-lg" id="description" name="description" rows="5">{{ $category_service->description }}</textarea>
                </div>
                <div class="mb-3 fs-5">
                    <label for="status" class="form-label fs-5">Trạng thái</label>
                    <input type="text" class="form-control form-control-lg" id="status" name="status" value="{{ $category_service->status }}">
                </div>
            </div>

            <div class="card-action p-3 text-center">
                <a href="{{url()->previous()}}" class="btn btn-warning mx-2"><i class="fa fa-arrow-left pe-2"></i>Trở về</a>
            </div>
        </div>
    </div>
@endsection
