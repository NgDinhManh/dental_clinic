@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Chỉnh sửa danh mục dịch vụ</h4>
        </div> 
        <div class="page-body">
            <div class="mb-3 fs-5">
                <label for="category_name" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control form-control-lg" id="category_name" name="category_name" rows="8" value="{{ $category_service->category_name }}" required>
            </div>
            <div class="mb-3 fs-5">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control form-control-lg" id="description" name="description" rows="5">{{ $category_service->description }}</textarea>
            </div>  
            <div class="mb-3 fs-5">
                <label for="status" class="form-label">Trạng thái</label>
                <input type="text" class="form-control form-control-lg" id="status" name="status" value="{{ $category_service->status }}">
            </div>
            <div class="row">
                <a href="{{url()->previous()}}" class="btn btn-warning fs-5 col-2 mx-2"><i class="fa fa-arrow-left mx-2"></i>Trở về</a>
            </div>
        </div>
    </div>  
@endsection