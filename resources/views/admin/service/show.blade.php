@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/service/update', $service->service_id) }}" method="post" class="card p-4"
            enctype="multipart/form-data">
            @csrf @method('put')
            <div class="row">
                <h4 class="card-title">Sửa dịch vụ</h4>

                <div class="form-group">
                    <label class="fs-5">Tên dịch vụ</label>
                    <input type="text" class="form-control form-control-lg" name="service_name"
                        value="{{ $service->service_name }}" required>
                </div>

                <div class="form-group">
                    <label class="fs-5">Mô tả</label>
                    <textarea name="description" class="form-control form-control-lg" rows="5">{{ old('description', $service->description ?? '') }}</textarea>
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

                <div class="form-group col-6">
                    <label class="fs-5">Ảnh</label><br>
                    <img id="previewImage" src=" {{ asset('storage/images/services/' . $service->image) }} "
                        alt="Xem trước ảnh" class="img-thumbnail shadow-sm rounded" style="max-width: 200px;">
                </div>

                <div class="row">
                    <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/service') }}"><i
                            class="fa fa-arrow-left mx-2"></i>Trở về</a>
                </div>
            </div>
        </form>
    </div>
@endsection
