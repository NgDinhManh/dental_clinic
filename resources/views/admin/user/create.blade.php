@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/user/store') }}" method="post" class="card p-4" enctype="multipart/form-data">
            @csrf
            <h4 class="card-title">Thêm người dùng</h4>
            <div class="row">
                <div class="col-4">
                    <div class="form-group text-center mt-4">
                        <label class="avatar-wrapper" for="avatar-input">
                            <img id="avatar-preview" src="{{ asset('admin_assets/img/avatar_default.png') }}"
                                class="avatar img-thumbnail shadow-sm rounded-circle" alt="Avatar">
                        </label>
                        <input type="file" id="avatar-input" accept="image/*"><br>
                        <label class="fs-5">Ảnh đại diện</label>
                    </div>
                </div>

                <div class="col row">
                    <div class="form-group">
                        <label class="fs-5">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="fullname">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Giới tính <span class="text-danger">*</span></label>
                        <select name="gender" class="form-select form-control-lg">
                            <option value="0" selected>Nam</option>
                            <option value="1">Nữ</option>
                            <option value="2">Khác</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Ngày sinh <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-lg" name="birthday">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control form-control-lg" name="phone">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Email</label>
                        <input type="email" class="form-control form-control-lg" name="email">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Địa chỉ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="address">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Tên người dùng <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="name">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Mật khẩu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" value="123456" disabled>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Vai trò</label>
                        <select class="form-select form-control-lg" name="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Trạng thái hoạt động</label>
                        <select class="form-select form-control-lg" name="is_active" id="">
                            <option value="1" selected>Hoạt động</option>
                            <option value="0">Khóa</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-action mt-4 p-3 text-center">
                <button type="submit" class="btn btn-success"><i class="fa fa-save mx-2"></i>Lưu</button>
                <a class="btn btn-warning mx-2" href="{{ route('admin/user') }}"><i class="fa fa-arrow-left mx-2"></i>
                    Trở về</a>
            </div>
        </form>
    </div>

    <style>
        .avatar-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .avatar {
            width: 200px;
            height: 200px;
            object-fit: cover;
            transition: 0.3s;
        }

        .avatar:hover {
            opacity: 0.8;
        }

        /* Ẩn input file thật */
        #avatar-input {
            display: none;
        }

        /* Icon máy ảnh hiển thị khi hover */
        .avatar-wrapper::after {
            content: "📷";
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 5px;
            border-radius: 50%;
            font-size: 18px;
            display: none;
        }

        .avatar-wrapper:hover::after {
            display: block;
        }
    </style>

    <script>
        const input = document.getElementById('avatar-input');
        const preview = document.getElementById('avatar-preview');

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result; // đổi ảnh hiển thị
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
