@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/receptionist/update', $receptionist->receptionist_id) }}" method="POST"
            class="card">
            @csrf @method('PUT')

            <div class="card-header">
                <h4 class="card-title">Sửa thông tin tiếp tân</h4>
            </div>

            <div class="card-body row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fs-5">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="fullname" value="{{ $receptionist->fullname }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Giới tính <span class="text-danger">*</span></label>
                        <select name="gender" class="form-control form-control-lg">
                            <option value="Nam" {{ $receptionist->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ $receptionist->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            <option value="Khác" {{ $receptionist->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ngày sinh <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-lg" name="birthday"  value="{{ $receptionist->birthday }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control form-control-lg" name="phone"  value="{{ $receptionist->user->phone }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Địa chỉ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="address"  value="{{ $receptionist->address }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fs-5">Ngày bắt đầu làm việc <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-lg" name="start_date"
                            value="{{ $receptionist->start_date }}" required>
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ca làm việc <span class="text-danger">*</span></label>
                        <select name="shift" class="form-control form-control-lg" required>
                            <option value="Sáng" {{ $receptionist->shift == 'Sáng' ? 'selected' : '' }}>Sáng</option>
                            <option value="Chiều" {{ $receptionist->shift == 'Chiều' ? 'selected' : '' }}>Chiều</option>
                            <option value="Tối" {{ $receptionist->shift == 'Tối' ? 'selected' : '' }}>Tối</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ghi chú</label>
                        <input type="text" class="form-control form-control-lg" name="note" value="{{ $receptionist->note }}">
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
