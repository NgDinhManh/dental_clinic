@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="card">

            <div class="card-header">
                <h4>Thông tin bài viết</h4>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label class="fs-5">Tiêu đề</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $post->title }}" required>
                </div>

                <div class="form-group">
                    <label class="fs-5">Tóm tắt</label>
                    <textarea class="form-control form-control-lg">{{ old('abstract', $post->abstract ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="fs-5">Nội dung</label>
                    <textarea class="form-control form-control-lg" id="contents" >
                        {!! old('contents', $post->contents ?? '') !!}
                    </textarea>
                </div>

                <div class="form-group">
                    <label class="fs-5">Ảnh bìa</label><br>
                    <img id="previewImage" src="{{ asset('storage/images/' . $post->images) }}" alt="Xem trước ảnh"
                        class="img-thumbnail shadow-sm rounded" style="max-width: 200px;">
                </div>

                <div class="form-group">
                    <label class="fs-5">Link</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $post->link }}">
                </div>

                <div class="form-group">
                    <label class="fs-5">Chủ đề</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $post->topic }}">
                </div>

                <div class="form-group">
                    <label class="fs-5">Tác giả</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $post->author }}">
                </div>

                <div class="form-group">
                    <label class="fs-5">Thứ tự</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $post->postorder }}">
                </div>

                <div class="form-check">
                    <input class="form-check-input fs-5" type="checkbox" value="1" id="flexCheckDefault"
                        {{ old('is_active', $post->is_active) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label fs-5" for="flexCheckDefault">
                        Hiển thị
                    </label>
                </div>

                <div class="row">
                    <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/post') }}"><i
                            class="fa fa-arrow-left mx-2"></i>Trở về</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@4.0.10/js/froala_editor.pkgd.min.js'>
    </script>
    <script>
        // Chèn trình soạn thảo văn bản vào vùng nội dung
        new FroalaEditor( '#contents' ,{
            imageUploadURL: "{{ route('admin/post/upload') }}", // API upload ảnh
            imageUploadParams: {
                _token: "{{ csrf_token() }}" // CSRF token để bảo mật
            },
            height: 700,
            scrollebaleContainer: true
        });
    </script>
@endsection
