@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/user/update', $user->user_id) }}" method="post" class="card p-4 row"
            enctype="multipart/form-data">
            @csrf @method('put')

            <div class="card-header">
                <h4 class="card-title">Sửa người dùng</h4>
            </div>

            <div class="card-body row">
                <div class="col-4">
                    <div class="form-group text-center mt-4">
                        <label class="image-upload-wrapper" for="image-upload-input">
                            <img id="image-upload-preview" src="{{ asset('storage/images/avatar/' . $user->avatar) }}"
                                class="image-upload img-thumbnail shadow-sm rounded-circle" alt="Avatar">
                        </label>
                        <input type="file" id="image-upload-input" name="avatar" accept="image/*"><br>
                        <label class="fs-5">Ảnh đại diện</label>
                    </div>
                </div>

                <div class="col row">
                    <div class="form-group">
                        <label class="fs-5">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="fullname"
                            value="{{ $user->fullname }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Giới tính <span class="text-danger">*</span></label>
                        <select name="gender" class="form-select form-control-lg">
                            <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Nam</option>
                            <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nữ</option>
                            <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Ngày sinh <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-lg" name="birthday"
                            value="{{ $user->birthday }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control form-control-lg" name="phone"
                            value="{{ $user->phone }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Email</label>
                        <input type="email" class="form-control form-control-lg" name="email"
                            value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Địa chỉ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="address"
                            value="{{ $user->address }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Tên người dùng <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="name"
                            value="{{ $user->name }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Vai trò</label>
                        <select class="form-select form-control-lg" name="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}"
                                    {{ $user->role_id == $role->role_id ? 'selected' : '' }}>
                                    {{ $role->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Trạng thái hoạt động</label>
                        <select class="form-select form-control-lg" name="is_active" id="">
                            <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}>Khóa</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-action p-3 text-center mt-4">
                <a class="btn btn-warning mx-2" href="{{ route('admin/user') }}">
                    <i class="fa fa-arrow-left pe-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success mx-2"><i class="fa fa-save pe-2"></i>Lưu</button>
            </div>
        </form>
        <form action="{{ route('admin/user/reset_password', $user->user_id) }}" method="post" class="card p-4 row">
            @csrf
            <div class="d-flex justify-content-center">
                <h4 class="d-flex align-items-center m-0">Cài lại mật khẩu mặc định: 123456</h4>
                <button type="submit" class="btn btn-primary mx-3"> <i class="fa-solid fa-rotate-right mx-2"></i>
                    Cài lại mật khẩu</button>
            </div>
        </form>
    </div>
@endsection
