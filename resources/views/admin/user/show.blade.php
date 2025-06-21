@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thông tin người dùng</h4>
            </div>
            <div class="card-body row">

                <div class="form-group col-6">
                    <label class="fs-5">Họ và tên</label>
                    <input type="text" class="form-control form-control-lg" name="fullname" value="{{ $user->fullname }}">
                </div>
    
                <div class="form-group col-3">
                    <label class="fs-5">Giới tính</label>
                    <select name="gender" class="form-select form-control-lg">
                        <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Nam</option>
                        <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nữ</option>
                        <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
    
                <div class="form-group col-3">
                    <label class="fs-5">Ngày sinh</label>
                    <input type="date" class="form-control form-control-lg" value="{{ $user->birthday }}">
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Số điện thoại</label>
                    <input type="tel" class="form-control form-control-lg" value="{{ $user->phone }}">
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Email</label>
                    <input type="email" class="form-control form-control-lg" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label class="fs-5">Địa chỉ</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $user->address }}">
                </div>
    
                <div class="form-group col-6">
                    <label class="fs-5">Ảnh đại diện</label><br>
                    <img id="previewImage" src="{{ asset('storage/images/' . $user->avatar) }}" alt="Xem trước ảnh"
                        class="img-thumbnail shadow-sm rounded" style="max-width: 200px;">
                </div>
    
                <div class="form-check col-6">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input fs-5" type="checkbox" value="1" id="flexCheckDefault"
                        {{ old('isactive', $user->is_active) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label fs-5" for="flexCheckDefault">
                        Trạng thái hoạt động
                    </label>
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Tên người dùng</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $user->name }}">
                </div>

                <div class="form-group col-6">
                    <label class="fs-5">Vai trò</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $rolename }}">
                </div>

                
                    <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/user') }}">
                        <i class="fa fa-arrow-left mx-2"></i>Trở về</a>
                
            </div>
        </div>

    </div>
@endsection
