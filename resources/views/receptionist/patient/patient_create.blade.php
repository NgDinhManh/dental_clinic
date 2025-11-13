@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <form action="{{ route('receptionist/patient/store') }}" method="POST" class="card">
            @csrf
            <div class="card-header">
                <h4 class="card-title">Thông tin cá nhân</h4>
            </div>

            <div class="card-body row">
                <div class="form-group col-6">
                    <label class="largeInput">Họ và tên <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" name="fullname" required>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Tên tài khoản <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Ngày sinh <span class="text-danger">(*)</span></label>
                    <input type="date" class="form-control" name="birthday" required>
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Giới tính <span class="text-danger">(*)</span></label>
                    <select class="form-select form-control" name="gender" required>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Điện thoại <span class="text-danger">(*)</span></label>
                    <input type="tel" class="form-control" name="phone" required>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Địa chỉ <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" name="address" required>
                </div>
            </div>

            <div class="card-header">
                <h4 class="card-title mt-4">Thông tin y tế</h4>
            </div>

            <div class="card-body row">
                <div class="form-group col-6">
                    <label class="largeInput">Số CCCD <span class="text-danger">(*)</span></label>
                    <input type="number" class="form-control" name="cccd" required>
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Số thẻ BHYT <span class="text-danger">(*)</span></label>
                    <input type="number" class="form-control" name="bhyt" required>
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Nhóm máu <span class="text-danger">(*)</span></label>
                    <select class="form-select form-control" name="blood_type" required>
                        <option value="" selected>Chọn nhóm máu</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Dị ứng (nếu có)</label>
                    <textarea class="form-control" name="allergies" rows="5"></textarea>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Tiền sử bệnh (nếu có)</label>
                    <textarea class="form-control" name="medical_history" rows="5"></textarea>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Tiền sử nha khoa (nếu có)</label>
                    <textarea class="form-control" name="dental_history" rows="5"></textarea>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Thuốc đang sử dụng (nếu có)</label>
                    <textarea class="form-control" name="current_medications" rows="5"></textarea>
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Người liên hệ khẩn cấp <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" name="emergency_contact">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Số điện thoại người liên hệ khẩn cấp <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" name="emergency_contact_phone">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Địa chỉ người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control" name="emergency_contact_address">
                </div>
            </div>

            <div class="card-action text-center p-3">
                <a class="btn btn-warning mx-2" href="{{ route('receptionist/patient') }}"><i
                    class="fa fa-arrow-left me-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success"><i
                        class="fa fa-save me-2"></i>Lưu</button>
            </div>
        </form>
    </div>
@endsection
