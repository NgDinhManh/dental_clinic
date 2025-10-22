@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <div class="card p-4">
            <div class="row">
                <h4 class="card-title">Thông tin cá nhân</h4>

                <input type="text" name="user_id" value="{{ $user->user_id }}" hidden>

                <div class="form-group col-6">
                    <label class="largeInput">Họ và tên</label>
                    <input type="text" class="form-control form-control" value="{{ $user->fullname }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Tên tài khoản</label>
                    <input type="text" class="form-control form-control" value="{{ $user->name }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Ngày sinh</label>
                    <input type="date" class="form-control form-control" value="{{ $user->birthday }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Giới tính</label>
                    <select class="form-select" name="gender" id="">
                        <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Nam</option>
                        <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nữ</option>
                        <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Điện thoại</label>
                    <input type="tel" class="form-control form-control" value="{{ $user->phone }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Email</label>
                    <input type="email" class="form-control form-control" value="{{ $user->email }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Địa chỉ</label>
                    <input type="text" class="form-control form-control" value="{{ $user->address }}">
                </div>

                <h4 class="card-title mt-4">Thông tin y tế</h4>

                <div class="form-group col-6">
                    <label class="largeInput">Số CCCD</label>
                    <input type="number" class="form-control form-control" value="{{ $patient->cccd }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Số thẻ BHYT</label>
                    <input type="number" class="form-control form-control" value="{{ $patient->bhyt }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Nhóm máu</label>
                    <select class="form-select form-control" value="{{ $patient->blood_type }}">
                        <option value="A" {{ $patient->blood_type == 'A' ? 'selected' : ''}}>A</option>
                        <option value="B" {{ $patient->blood_type == 'B' ? 'selected' : ''}}>B</option>
                        <option value="AB" {{ $patient->blood_type == 'AB' ? 'selected' : ''}}>AB</option>
                        <option value="O" {{ $patient->blood_type == 'O' ? 'selected' : ''}}>O</option>
                    </select>
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
                    <input type="text" class="form-control form-control" value="{{ $patient->emergency_contact }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Số điện thoại người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control form-control"
                        value="{{ $patient->emergency_contact_phone }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Địa chỉ người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control form-control"
                        value="{{ $patient->emergency_contact_address }}">
                </div>

                <div class="row">
                    <a class="btn btn-warning largeInput col-2 mx-2" href="{{ route('receptionist/patient') }}"><i
                            class="fa fa-arrow-left mx-2"></i>Trở về</a>
                </div>
            </div>
        </div>
    </div>
@endsection
