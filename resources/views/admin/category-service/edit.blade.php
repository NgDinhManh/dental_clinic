@extends('layouts.admin')

@section('content')
    <div class="page-inner">

        <form action="{{ route('admin/category-service/update', $category_service->category_id) }}" method="POST" class="card"
            enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="card-header">
                <h4 class="page-title">Chỉnh sửa danh mục dịch vụ</h4>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="category_name" class="fs-5 form-label">Tên danh mục</label>
                    <input type="text" class="form-control form-control-lg" id="category_name" name="category_name"
                        rows="8" value="{{ $category_service->category_name }}" required>
                </div>
                <div class="form-group">
                    <label for="description" class="fs-5 form-label">Mô tả</label>
                    <textarea class="form-control form-control-lg" id="description" name="description" rows="5">{{ $category_service->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status" class="fs-5 form-label">Trạng thái</label>
                    <select class="form-select form-select-lg" id="status" name="status">
                        <option value="Có sẵn" {{ $category_service->status == 'Có sẵn' ? 'selected' : '' }}>Có sẵn</option>
                        <option value="Tạm ngưng" {{ $category_service->status == 'Tạm ngưng' ? 'selected' : '' }}>Tạm ngưng
                        </option>
                    </select>
                </div>
            </div>

            <div class="card-action p-3 text-center">
                <a class="btn btn-warning mx-2" href="{{ url()->previous() }}"><i
                        class="fa fa-arrow-left pe-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save pe-2"></i>Lưu</button>
            </div>
        </form>
    </div>
@endsection
