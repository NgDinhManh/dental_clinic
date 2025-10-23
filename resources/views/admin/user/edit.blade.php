@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/user/update', $user->user_id) }}" method="post" class="card p-4 row" enctype="multipart/form-data">
            @csrf @method('put')
            <h4 class="card-title">Sửa người dùng</h4>

            <div class="form-group">
                <label class="fs-5">Họ và tên</label>
                <input type="text" class="form-control form-control-lg" name="fullname" value="{{ $user->fullname }}">
            </div>

            <div class="form-group">
                <label class="fs-5">Giới tính</label>
                <select name="gender" class="form-select form-control-lg">
                    <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Nam</option>
                    <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nữ</option>
                    <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label class="fs-5">Ngày sinh</label>
                <input type="date" class="form-control form-control-lg" name="birthday" value="{{ $user->birthday }}">
            </div>

            <div class="form-group">
                <label class="fs-5">Số điện thoại</label>
                <input type="tel" class="form-control form-control-lg" name="phone" value="{{ $user->phone }}">
            </div>

            <div class="form-group">
                <label class="fs-5">Email</label>
                <input type="email" class="form-control form-control-lg" name="email" value="{{ $user->email }}">
            </div>

            <div class="form-group">
                <label class="fs-5">Địa chỉ</label>
                <input type="text" class="form-control form-control-lg" name="address" value="{{ $user->address }}">
            </div>

            <div class="form-group">
                <label class="fs-5">Ảnh đại diện</label>
                <img id="previewImage" src="{{ asset('storage/images/' . $user->avatar) }}" alt="Xem trước ảnh"
                    class="img-thumbnail shadow-sm rounded" style="max-width: 200px;">
                <input type="file" class="form-control form-control-lg" id="imageInput" name="avatar" accept="image/*">
            </div>

            <div class="form-check">
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input fs-5" type="checkbox" value="1" id="flexCheckDefault" name="is_active"
                    {{ old('is_active', $user->is_active) == 1 ? 'checked' : '' }}>
                <label class="form-check-label fs-5" for="flexCheckDefault">
                    Trạng thái hoạt động
                </label>
            </div>

            <div class="form-group">
                <label class="fs-5">Tên người dùng</label>
                <input type="text" class="form-control form-control-lg" name="name" value="{{ $user->name }}">
            </div>

            <div class="form-group">
                <label class="fs-5">Vai trò</label>
                <select class="form-select form-control-lg" name="role_id">
                    @foreach ($roles as $role)
                        <option value="{{ $role->role_id }}" {{ $user->role_id == $role->role_id ? 'selected' : '' }}>
                            {{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-success fs-5 col-2 mx-2"><i class="fa fa-save mx-2"></i>Lưu</button>
                <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/user') }}">
                    <i class="fa fa-arrow-left mx-2"></i>Trở về</a>
            </div>
        </form>
        <form action="{{ route('admin/user/reset_password', $user->user_id) }}" method="post" class="card p-4 row">
            @csrf
            <div class="d-flex justify-content-center">
                <h4 class="d-flex align-items-center m-0">Cài lại mật khẩu mặc định: 123456</h4>
                <button type="submit" class="btn btn-primary mx-3"> <i class="fa-solid fa-rotate-right mx-2"></i>Cài lại mật
                    khẩu</button>
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
                    const previewImage = document.getElementById("previewImage");
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
