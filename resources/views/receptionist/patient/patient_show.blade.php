@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thông tin cá nhân</h4>
            </div>
            <div class="card-body row">
                <div class="form-group col-6">
                    <label class="largeInput">Họ và tên</label>
                    <input type="text" class="form-control" value="{{ $patient->fullname }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Tên tài khoản</label>
                    <input type="text" class="form-control" value="{{ $user->name }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Ngày sinh</label>
                    <input type="date" class="form-control" value="{{ $patient->birthday }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Giới tính</label>
                    <input type="text" class="form-control" value="{{ $patient->gender }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Điện thoại</label>
                    <input type="tel" class="form-control" value="{{ $user->phone }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Địa chỉ</label>
                    <input type="text" class="form-control" value="{{ $patient->address }}">
                </div>

                <h4 class="card-title mt-4">Thông tin y tế</h4>

                <div class="form-group col-6">
                    <label class="largeInput">Số CCCD</label>
                    <input type="number" class="form-control" value="{{ $patient->cccd }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Số thẻ BHYT</label>
                    <input type="number" class="form-control" value="{{ $patient->bhyt }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Nhóm máu</label>
                    <input type="text" class="form-control" value="{{ $patient->blood_type }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Dị ứng (nếu có)</label>
                    <textarea class="form-control" rows="5">{{ $patient->allergies }}</textarea>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Tiền sử bệnh (nếu có)</label>
                    <textarea class="form-control" rows="5">{{ $patient->medical_history }}</textarea>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Tiền sử nha khoa (nếu có)</label>
                    <textarea class="form-control" rows="5">{{ $patient->dental_history }}</textarea>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Thuốc đang sử dụng (nếu có)</label>
                    <textarea class="form-control" rows="5">{{ $patient->current_medications }}</textarea>
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control" value="{{ $patient->emergency_contact }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Số điện thoại người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control"
                        value="{{ $patient->emergency_contact_phone }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Địa chỉ người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control"
                        value="{{ $patient->emergency_contact_address }}">
                </div>
            </div>

            <div class="card-action text-center p-3">
                <a class="btn btn-warning" href="{{ route('receptionist/patient') }}"><i
                        class="fa fa-arrow-left me-2"></i>Trở về</a>
            </div>
        </div>
    </div>
@endsection
