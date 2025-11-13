@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <form action="{{ route('receptionist/patient/update', $patient->patient_id) }}" method="POST" class="card">
            @csrf @method('PUT')
            <div class="card-header">
                <h4 class="card-title">Thông tin cá nhân</h4>
            </div>

            <div class="card-body row">
                <div class="form-group col-6">
                    <label class="largeInput">Họ và tên</label>
                    <input type="text" class="form-control form-control" name="fullname" value="{{ $patient->fullname }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Tên tài khoản</label>
                    <input type="text" class="form-control form-control" name="name" value="{{ $user->name }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Ngày sinh</label>
                    <input type="date" class="form-control form-control" name="birthday" value="{{ $patient->birthday }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Giới tính</label>
                    <select class="form-select" name="gender" id="">
                        <option value="Nam" {{ $patient->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ $patient->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ $patient->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Điện thoại</label>
                    <input type="tel" class="form-control form-control" name="phone" value="{{ $user->phone }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Email</label>
                    <input type="email" class="form-control form-control" name="email" value="{{ $user->email }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Địa chỉ</label>
                    <input type="text" class="form-control form-control" name="address" value="{{ $patient->address }}">
                </div>
            </div>

            <div class="card-header">
                <h4 class="card-title mt-4">Thông tin y tế</h4>
            </div>

            <div class="card-body row">
                <div class="form-group col-6">
                    <label class="largeInput">Số CCCD</label>
                    <input type="number" class="form-control form-control" name="cccd" value="{{ $patient->cccd }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Số thẻ BHYT</label>
                    <input type="number" class="form-control form-control" name="bhyt" value="{{ $patient->bhyt }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Nhóm máu</label>
                    <select class="form-select form-control" name="blood_type">
                        <option value="">Chọn nhóm máu</option>
                        <option value="A" {{ $patient->blood_type == 'A' ? 'selected' : ''}}>A</option>
                        <option value="B" {{ $patient->blood_type == 'B' ? 'selected' : ''}}>B</option>
                        <option value="AB" {{ $patient->blood_type == 'AB' ? 'selected' : ''}}>AB</option>
                        <option value="O" {{ $patient->blood_type == 'O' ? 'selected' : ''}}>O</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Dị ứng (nếu có)</label>
                    <textarea class="form-control" name="allergies" rows="5">{{ $patient->allergies }}</textarea>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Tiền sử bệnh (nếu có)</label>
                    <textarea class="form-control" name="medical_history" rows="5">{{ $patient->medical_history }}</textarea>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Tiền sử nha khoa (nếu có)</label>
                    <textarea class="form-control" name="dental_history" rows="5">{{ $patient->dental_history }}</textarea>
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Thuốc đang sử dụng (nếu có)</label>
                    <textarea class="form-control" name="current_medications" rows="5">{{ $patient->current_medications }}</textarea>
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control form-control" name="emergency_contact" value="{{ $patient->emergency_contact }}">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Số điện thoại người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control form-control" name="emergency_contact_phone"
                        value="{{ $patient->emergency_contact_phone }}">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Địa chỉ người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control form-control" name="emergency_contact_address"
                        value="{{ $patient->emergency_contact_address }}">
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
