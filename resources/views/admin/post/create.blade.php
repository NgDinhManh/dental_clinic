@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/post/store') }}" method="POST" enctype="multipart/form-data" class="card p-4 row">
            @csrf

            <div class="card-header">
                <h4>Thêm bài viết</h4>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label class="fs-5">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg" name="title" required>
                </div>

                <div class="form-group">
                    <label class="fs-5">Tóm tắt <span class="text-danger">*</span></label>
                    <textarea name="abstract" class="form-control form-control-lg"></textarea>
                </div>

                <div class="form-group">
                    <label class="fs-5">Nội dung <span class="text-danger">*</span></label>
                    <textarea class="form-control form-control-lg" id="contents" name="contents"></textarea>
                </div>

                <div class="form-group">
                    <label class="fs-5">Ảnh bìa <span class="text-danger">*</span></label><br>
                    <img id="previewImage" src="#" alt="Xem trước ảnh" class="img-thumbnail shadow-sm rounded d-none"
                        style="max-width: 200px;">
                    <input type="file" class="form-control form-control-lg" id="imageInput" name="images" accept="image/*">
                </div>

                <div class="form-group">
                    <label class="fs-5">Link</label>
                    <input type="text" class="form-control form-control-lg" name="link">
                </div>

                <div class="form-group">
                    <label class="fs-5">Chủ đề <span class="text-danger">*</span></label>
                    <select class="form-select form-control-lg" name="topic">
                        <option value="Dịch vụ">Dịch vụ</option>
                        <option value="Tin tức & sự kiện">Tin tức & sự kiện</option>
                        <option value="Kiến thức răng miệng">Kiến thức răng miệng</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="fs-5">Tác giả <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg" name="author" required>
                </div>

                <div class="form-group">
                    <label class="fs-5">Thứ tự <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg" name="post_order">
                </div>

                <div class="form-check">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input fs-5" type="checkbox" value="1" id="flexCheckDefault" name="is_active"
                        {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label fs-5" for="flexCheckDefault">
                        Hiển thị
                    </label>
                </div>
            </div>

            <div class="card-action p-3 text-center">
                <a class="btn btn-warning mx-2" href="{{ route('admin/post') }}"><i class="fa fa-arrow-left pe-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save pe-2"></i>Lưu</button>
            </div>
        </form>
    </div>

    <!-- JS -->
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@4.0.10/js/froala_editor.pkgd.min.js'>
    </script>
    <script>
        // Chèn trình soạn thảo văn bản vào vùng nội dung
        new FroalaEditor('#contents', {
            imageUploadURL: "{{ route('admin/post/upload') }}", // API upload ảnh
            imageUploadParams: {
                _token: "{{ csrf_token() }}" // CSRF token để bảo mật
            },
            height: 700,
            scrollebaleContainer: true,
        });

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
