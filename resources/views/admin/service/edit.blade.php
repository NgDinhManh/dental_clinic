@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/service/update', $service->service_id) }}" method="post" class="card p-4"
            enctype="multipart/form-data">
            @csrf @method('put')

            <div class="card-header">
                <h4 class="card-title">Sửa dịch vụ</h4>
            </div>

            <div class="card-body row">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group text-center mt-4">
                            <label class="image-upload-wrapper" for="image-upload-input">
                                <img id="image-upload-preview" src="{{ asset('storage/images/service/' . $service->image) }}"
                                    class="image-upload img-thumbnail shadow-sm rounded" alt="Service Image Preview">
                            </label>
                            <input type="file" id="image-upload-input" name="image" accept="image/*"><br>
                            <label class="fs-5">Ảnh dịch vụ <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="fs-5">Tên dịch vụ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" name="service_name"
                                value="{{ $service->service_name }}" required>
                        </div>

                        <div class="form-group">
                            <label class="fs-5">Mô tả</label>
                            <textarea name="description" class="form-control form-control-lg" rows="5">{{ old('description', $service->description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Giá tiền <span class="text-danger">*</span></label>
                    <input type="money" class="form-control form-control-lg" name="price" value="{{ $service->price }}"
                        required>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Thời gian thực hiện <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg" name="duration"
                        value="{{ $service->duration }}" required>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Trạng thái <span class="text-danger">*</span></label>
                    <select class="form-select form-control-lg" name="status">
                        <option value="Có sẵn" {{ $service->status == 'Có sẵn' ? 'selected' : '' }}>Có sẵn</option>
                        <option value="Tạm ngưng" {{ $service->status == 'Tạm ngưng' ? 'selected' : '' }}>Tạm ngưng</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Danh mục dịch vụ <span class="text-danger">*</span></label>
                    <select class="form-select form-control-lg" name="category_id">
                        <option value="">---</option>
                        @foreach ($category_services as $category_service)
                            <option value="{{ $category_service->category_id }}"
                                {{ $service->category_id == $category_service->category_id ? 'selected' : '' }}>
                                {{ $category_service->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Bài viết</label>
                    <select class="form-select form-control-lg" name="post_id">
                        <option value="">---</option>
                        @foreach ($post_services as $post_service)
                            <option value="{{ $post_service->post_id }}"
                                {{ $service->post_id == $post_service->post_id ? 'selected' : '' }}>{{ $post_service->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-action p-3 text-center">
                <a class="btn btn-warning mx-2" href="{{ route('admin/service') }}"><i
                        class="fa fa-arrow-left pe-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save pe-2"></i>Lưu</button>
            </div>
        </form>
    </div>
@endsection
