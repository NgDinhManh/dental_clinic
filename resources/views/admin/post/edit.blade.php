@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/post/update', $post->postid) }}" method="POST" enctype="multipart/form-data"
            class="card">
            @csrf @method('put')
            <div class="card-header">
                <h4>Chỉnh sửa bài viết</h4>
            </div>

            <div class="card-body row">
                <div class="form-group">
                    <label class="fs-5">Tiêu đề</label>
                    <input type="text" class="form-control form-control-lg" name="title" value="{{ $post->title }}"
                        required>
                </div>

                <div class="form-group">
                    <label class="fs-5">Tóm tắt</label>
                    <textarea class="form-control form-control-lg" name="abstract">{{ old('abstract', $post->abstract ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="fs-5">Nội dung</label>
                    <textarea class="form-control form-control-lg" id="contents" name="contents">{{ old('contents', $post->contents ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="fs-5">Ảnh bìa</label><br>
                    <img id="previewImage" src="{{ asset('storage/images/' . $post->images) }}" alt="Xem trước ảnh"
                        class="img-thumbnail shadow-sm rounded" style="max-width: 200px;">
                    <input type="file" class="form-control form-control-lg" id="imageInput" name="images"
                        accept="image/*">
                </div>

                <div class="form-group">
                    <label class="fs-5">Link</label>
                    <input type="text" class="form-control form-control-lg" name="link" value="{{ $post->link }}">
                </div>

                <div class="form-group">
                    <label class="fs-5">Chủ đề</label>
                    <select class="form-select form-control-lg" name="topic">
                        <option value="Dịch vụ" {{ $post->topic == 'Dịch vụ' ? 'selected' : '' }}>Dịch vụ</option>
                        <option value="Tin tức & sự kiện" {{ $post->topic == 'Tin tức & sự kiện' ? 'selected' : '' }}>Tin
                            tức & sự kiện</option>
                        <option value="Kiến thức răng miệng" {{ $post->topic == 'Kiến thức răng miệng' ? 'selected' : '' }}>
                            Kiến thức răng miệng</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="fs-5">Tác giả</label>
                    <input type="text" class="form-control form-control-lg" name="author" value="{{ $post->author }}"
                        required>
                </div>

                <div class="form-group">
                    <label class="fs-5">Thứ tự</label>
                    <input type="text" class="form-control form-control-lg" name="postorder"
                        value="{{ $post->postorder }}">
                </div>

                <div class="form-group">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input fs-5" type="checkbox" value="1" id="flexCheckDefault"
                        name="is_active" {{ old('is_active', $post->is_active) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label fs-5" for="flexCheckDefault">
                        Hiển thị
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success fs-5 col-2"><i class="fa fa-save mx-2"></i>Lưu</button>
                    <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/post') }}"><i
                            class="fa fa-arrow-left mx-2"></i>Trở về</a>
                </div>
            </div>
        </form>
    </div>

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
                    const previewImage = document.getElementById("previewImage");
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
