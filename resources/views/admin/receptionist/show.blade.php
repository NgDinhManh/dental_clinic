@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thông tin tiếp tân</h4>
            </div>

            <div class="card-body row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fs-5">Họ và tên</label>
                        <input type="text" class="form-control form-control-lg" value="{{ $receptionist->fullname }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Giới tính</label>
                        <input type="text" class="form-control form-control-lg" value="{{ $receptionist->gender }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ngày sinh</label>
                        <input type="date" class="form-control form-control-lg" value="{{ $receptionist->birthday }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Số điện thoại</label>
                        <input type="tel" class="form-control form-control-lg" value="{{ $receptionist->user->phone }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Địa chỉ</label>
                        <input type="text" class="form-control form-control-lg" value="{{ $receptionist->address }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fs-5">Ngày bắt đầu làm việc</label>
                        <input type="text" class="form-control form-control-lg"
                            value="{{ $receptionist->start_date }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ca làm việc</label>
                        <input type="text" class="form-control form-control-lg"
                            value="{{ $receptionist->shift }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ghi chú</label>
                        <input type="text" class="form-control form-control-lg" value="{{ $receptionist->note }}">
                    </div>
                </div>
            </div>

            <div class="card-action p-3 text-center">
                <a class="btn btn-warning mx-2" href="{{ route('admin/receptionist') }}"><i
                        class="fa fa-arrow-left pe-2"></i>Trở về</a>
            </div>
        </div>
    </div>
@endsection
