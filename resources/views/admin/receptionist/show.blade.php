@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thông tin tiếp tân</h4>
            </div>
            <div class="card-body row">

                <div class="form-group col-md-6">
                    <label class="fs-5">Họ và tên</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $user->fullname }}">
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

                <div class="form-group col-md-6">
                    <label class="fs-5">Ngày bắt đầu làm việc</label>
                    <input type="text" class="form-control form-control-lg"
                        value="{{ $receptionist->start_date }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Ca làm việc</label>
                    <input type="text" class="form-control form-control-lg"
                        value="{{ $receptionist->shift }}">
                </div>

                <div class="form-group col-md-12">
                    <label class="fs-5">Ghi chú</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $receptionist->note }}">
                </div>

                <div class="row">
                    <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/receptionist') }}"><i
                            class="fa fa-arrow-left mx-2"></i>Trở về</a>
                </div>
            </div>
        </div>
    </div>
@endsection
