@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/service/store') }}" method="post" class="card p-4" enctype="multipart/form-data">
            @csrf

            <div class="card-header">
                <h4 class="card-title">Thêm dịch vụ</h4>
            </div>

            <div class="card-body row">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group text-center mt-4">
                            <label class="image-upload-wrapper" for="image-upload-input">
                                <img data-preview src="{{ asset('admin_assets/img/image_default.png') }}"
                                    class="image-upload img-thumbnail shadow-sm rounded" alt="Service Image Preview">
                            </label>
                            <input type="file" class="image-upload-input" id="image-upload-input" name="image" accept="image/*"><br>
                            <label class="fs-5">Ảnh dịch vụ <span class="text-danger">*</span></label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="fs-5">Tên dịch vụ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" name="service_name">
                        </div>

                        <div class="form-group">
                            <label class="fs-5">Mô tả</label>
                            <textarea name="description" class="form-control form-control-lg" rows="5"></textarea>
                        </div>
                    </div>
                </div>



                <div class="form-group col-6">
                    <label class="fs-5">Giá tiền <span class="text-danger">*</span></label>
                    <input type="money" class="form-control form-control-lg" name="price">
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Thời gian thực hiện <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg" name="duration">
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Trạng thái <span class="text-danger">*</span></label>
                    <select class="form-select form-control-lg" name="status">
                        <option value="Có sẵn">Có sẵn</option>
                        <option value="Tạm ngưng">Tạm ngưng</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Danh mục dịch vụ <span class="text-danger">*</span></label>
                    <select class="form-select form-control-lg" name="category_id">
                        <option value="">---</option>
                        @foreach ($category_services as $category_service)
                            <option value="{{ $category_service->category_id }}">{{ $category_service->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Bài viết</label>
                    <select class="form-select form-control-lg" name="post_id">
                        <option value="">---</option>
                        @foreach ($post_services as $post_service)
                            <option value="{{ $post_service->post_id }}">{{ $post_service->title }}</option>
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
