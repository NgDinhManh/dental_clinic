@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/receptionist/store') }}" method="POST" class="card">
            @csrf
            <div class="card-header">
                <h4 class="card-title">Thêm tiếp tân mới</h4>
            </div>

            <div class="card-body row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fs-5">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="fullname">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Giới tính <span class="text-danger">*</span></label>
                        <select name="gender" class="form-control form-control-lg">
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ngày sinh <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-lg" name="birthday">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control form-control-lg" name="phone">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Địa chỉ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="address">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fs-5">Ngày bắt đầu làm việc <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-lg" name="start_date">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ca làm việc <span class="text-danger">*</span></label>
                        <select name="shift" class="form-control form-control-lg">
                            <option value="Sáng">Sáng</option>
                            <option value="Chiều">Chiều</option>
                            <option value="Tối">Tối</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ghi chú</label>
                        <input type="text" class="form-control form-control-lg" name="note">
                    </div>
                </div>
            </div>

            <div class="card-action p-3 text-center">
                <a class="btn btn-warning mx-2" href="{{ route('admin/receptionist') }}"><i
                        class="fa fa-arrow-left pe-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save pe-2"></i>Lưu</button>
            </div>
        </form>
    </div>
@endsection
