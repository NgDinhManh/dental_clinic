@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/service/update', $service->service_id) }}" method="post" class="card p-4"
            enctype="multipart/form-data">
            @csrf @method('put')

            <div class="card-header">
                <h4 class="card-title">Chi tiết dịch vụ</h4>
            </div>

            <div class="card-body row">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group text-center mt-4">
                            <label>
                                <img id="image-upload-preview" src="{{ asset('storage/images/service/' . $service->image) }}"
                                    class="img-thumbnail shadow-sm rounded" alt="Service Image Preview">
                            </label><br>
                            <label class="fs-5">Ảnh dịch vụ</label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label class="fs-5">Tên dịch vụ</label>
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
                    <label class="fs-5">Giá tiền</label>
                    <input type="money" class="form-control form-control-lg" name="price" value="{{ $service->price }}"
                        required>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Thời gian thực hiện</label>
                    <input type="text" class="form-control form-control-lg" name="duration"
                        value="{{ $service->duration }}" required>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Trạng thái</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $service->status }}">
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Danh mục dịch vụ</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $service->category->category_name ?? 'Không có danh mục' }}">
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Bài viết</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $service->post->title ?? 'Không có bài viết' }}">
                </div>
            </div>

            <div class="card-action p-3 text-center">
                <a class="btn btn-warning" href="{{ route('admin/service') }}"><i
                        class="fa fa-arrow-left pe-2"></i>Trở về</a>
            </div>
        </form>
    </div>
@endsection
