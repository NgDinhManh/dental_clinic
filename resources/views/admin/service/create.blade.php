@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/service/store') }}" method="post" class="card p-4" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <h4 class="card-title">Thêm dịch vụ</h4>

                <div class="form-group">
                    <label class="fs-5">Tên dịch vụ</label>
                    <input type="text" class="form-control form-control-lg" name="service_name" required>
                </div>

                <div class="form-group">
                    <label class="fs-5">Mô tả</label>
                    <textarea name="description" class="form-control form-control-lg" rows="5"></textarea>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Giá tiền</label>
                    <input type="money" class="form-control form-control-lg" name="price" required>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Thời gian thực hiện</label>
                    <input type="text" class="form-control form-control-lg" name="duration" required>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Trạng thái</label>
                    <select class="form-select form-control-lg" name="status">
                        <option value="Có sẵn">Có sẵn</option>
                        <option value="Tạm ngưng">Tạm ngưng</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Danh mục dịch vụ</label>
                    <select class="form-select form-control-lg" name="category_id">
                        <option value="">---</option>
                        @foreach ($category_services as $category_service)
                            <option value="{{ $category_service->category_id }}">{{ $category_service->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Bài viết</label>
                    <select class="form-select form-control-lg" name="postid">
                        <option value="">---</option>
                        @foreach ($post_services as $post_service)
                            <option value="{{ $post_service->postid }}">{{ $post_service->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Ảnh</label><br>
                    <img id="previewImage" src="#" alt="Xem trước ảnh"
                        class="img-thumbnail shadow-sm rounded d-none" style="max-width: 200px;">
                    <input type="file" class="form-control form-control-lg" id="imageInput" name="image"
                        accept="image/*">
                </div>

                <div class="row">
                    <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/service') }}"><i
                            class="fa fa-arrow-left mx-2"></i>Trở về</a>
                    <button type="submit" class="btn btn-success fs-5 col-2"><i class="fa fa-save mx-2"></i>Lưu</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Hiển thị ảnh xem trước khi tải ảnh lên
        document.getElementById("imageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    var previewImage = document.getElementById("previewImage");
                    previewImage.src = e.target.result;
                    previewImage.classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
