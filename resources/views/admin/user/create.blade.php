@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/user/store') }}" method="post" class="card p-4 row" enctype="multipart/form-data">
            @csrf
            <h4 class="card-title">Thêm người dùng</h4>

            <div class="form-group">
                <label class="fs-5">Họ và tên</label>
                <input type="text" class="form-control form-control-lg" name="fullname">
            </div>

            <div class="form-group">
                <label class="fs-5">Giới tính</label>
                <select name="gender" class="form-select form-control-lg">
                    <option value="0" selected>Nam</option>
                    <option value="1">Nữ</option>
                    <option value="2">Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label class="fs-5">Ngày sinh</label>
                <input type="date" class="form-control form-control-lg" name="birthday">
            </div>

            <div class="form-group">
                <label class="fs-5">Số điện thoại</label>
                <input type="tel" class="form-control form-control-lg" name="phone">
            </div>

            <div class="form-group">
                <label class="fs-5">Email</label>
                <input type="email" class="form-control form-control-lg" name="email">
            </div>

            <div class="form-group">
                <label class="fs-5">Địa chỉ</label>
                <input type="text" class="form-control form-control-lg" name="address">
            </div>

            <div class="form-group">
                <label class="fs-5">Ảnh đại diện</label>
                <img id="previewImage" src="#" alt="Xem trước ảnh" class="img-thumbnail shadow-sm rounded d-none"
                    style="max-width: 200px;">
                <input type="file" class="form-control form-control-lg" id="imageInput" name="avatar" accept="image/*">
            </div>

            <div class="form-check">
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input fs-5" type="checkbox" value="1" id="flexCheckDefault" name="is_active"
                    {{ old('isactive', 0) == 1 ? 'checked' : '' }}>
                <label class="form-check-label fs-5" for="flexCheckDefault">
                    Trạng thái hoạt động
                </label>
            </div>

            <div class="form-group">
                <label class="fs-5">Tên người dùng</label>
                <input type="text" class="form-control form-control-lg" name="name">
            </div>

            <div class="form-group">
                <label class="fs-5">Mật khẩu</label>
                <input type="text" class="form-control form-control-lg" value="123456" disabled>
            </div>

            <div class="form-group">
                <label class="fs-5">Vai trò</label>
                <select class="form-select form-control-lg" name="roleid">
                    @foreach ($roles as $role)
                        <option value="{{ $role->roleid }}">{{ $role->rolename }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-success fs-5 col-2"><i class="fa fa-save mx-2"></i>Lưu</button>
                <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/user') }}"><i
                        class="fa fa-arrow-left mx-2"></i>Trở về</a>
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
