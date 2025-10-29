@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thông tin người dùng</h4>
            </div>

            <div class="card-body row">
                <div class="col-4">
                    <div class="form-group text-center mt-4">
                        <label class="avatar-wrapper" for="avatar-input">
                            <img id="avatar-preview" src="{{ asset('storage/images/avatar/' . $user->avatar) }}"
                                class="avatar img-thumbnail shadow-sm rounded-circle" alt="Avatar">
                        </label><br>
                        <label class="fs-5">Ảnh đại diện</label>
                    </div>
                </div>

                <div class="col row">
                    <div class="form-group col-md-6">
                        <label class="fs-5">Tên người dùng</label>
                        <input type="text" class="form-control form-control-lg" name="name"
                            value="{{ $user->name }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Số điện thoại</label>
                        <input type="tel" class="form-control form-control-lg" name="phone"
                            value="{{ $user->phone }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Email</label>
                        <input type="email" class="form-control form-control-lg" name="email"
                            value="{{ $user->email }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Vai trò</label>
                        <input type="text" class="form-control form-control-lg" name="name"
                            value="{{ $user->role->description }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="fs-5">Trạng thái hoạt động</label>
                        <input type="text" class="form-control form-control-lg" name="name"
                            value="{{ $user->is_active == 1 ? 'Hoạt động' : 'Khóa' }}">
                    </div>
                </div>
            </div>

            <div class="card-action mt-4 p-3 text-center">
                <a class="btn btn-warning mx-2" href="{{ route('admin/user') }}">
                <i class="fa fa-arrow-left mx-2"></i>Trở về</a>
            </div>
        </div>

    </div>

    <style>
        .avatar-wrapper {
            position: relative;
            display: inline-block;
        }

        .avatar {
            width: 200px;
            height: 200px;
            object-fit: cover;
            transition: 0.3s;
        }
    </style>
@endsection
