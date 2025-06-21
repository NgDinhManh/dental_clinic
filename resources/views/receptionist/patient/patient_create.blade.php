@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <form action="{{ route('receptionist/patient/create') }}" method="GET" class="card p-4">
            <h4 class="card-title">Tìm kiếm bệnh nhân</h4>
            <div class="form-group">
                <div class="input-icon">
                    <input type="tel" name="search_phone" class="form-control" placeholder="Nhập số điện thoại"
                        value="{{ request('search') }}">
                    <span class="input-icon-addon">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </form>


        <form action="{{ route('receptionist/patient/store') }}" method="POST" class="card p-4">
            <div class="row">
                @csrf
                <h4 class="card-title">Thông tin cá nhân</h4>

                @if (isset($user))

                    <input type="text" name="userid" value="{{ $user->userid }}" hidden>

                    <div class="form-group col-6">
                        <label class="largeInput">Họ và tên</label>
                        <input type="text" class="form-control form-control"
                            value="{{ $user->fullname }}">
                    </div>

                    <div class="form-group col-6">
                        <label class="largeInput">Tên tài khoản</label>
                        <input type="text" class="form-control form-control" 
                            value="{{ $user->name }}">
                    </div>

                    <div class="form-group col-3">
                        <label class="largeInput">Ngày sinh</label>
                        <input type="date" class="form-control form-control"
                            value="{{ $user->birthday }}">
                    </div>
                    
                    <div class="form-group col-3">
                        <label class="largeInput">Giới tính</label>
                        <select class="form-select" name="gender" id="">
                            <option value="0" {{ $user->gender == 0 ? 'selected' : ''}}>Nam</option>
                            <option value="1" {{ $user->gender == 1 ? 'selected' : ''}}>Nữ</option>
                            <option value="2" {{ $user->gender == 2 ? 'selected' : ''}}>Khác</option>
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
                        <input type="text" class="form-control form-control"
                            value="{{ $user->address }}">
                    </div>
                @else
                    <div class="form-group col-6">
                        <label class="largeInput">Họ và tên <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control form-control" name="fullname" required>
                    </div>

                    <div class="form-group col-6">
                        <label class="largeInput">Tên tài khoản <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control form-control" name="name" required>
                    </div>

                    <div class="form-group col-3">
                        <label class="largeInput">Ngày sinh <span class="text-danger">(*)</span></label>
                        <input type="date" class="form-control form-control" name="birthday" required>
                    </div>

                    <div class="form-group col-3">
                        <label class="largeInput">Giới tính <span class="text-danger">(*)</span></label>
                        <select class="form-select form-control-lg" name="gender" required>
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                            <option value="2">Khác</option>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label class="largeInput">Điện thoại <span class="text-danger">(*)</span></label>
                        <input type="tel" class="form-control form-control" name="phone" required>
                    </div>

                    <div class="form-group col-6">
                        <label class="largeInput">Email</label>
                        <input type="email" class="form-control form-control" name="email">
                    </div>

                    <div class="form-group col-6">
                        <label class="largeInput">Địa chỉ <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control form-control" name="address" required>
                    </div>
                @endif

                <h4 class="card-title mt-4">Thông tin y tế</h4>

                <div class="form-group col-6">
                    <label class="largeInput">Số CCCD <span class="text-danger">(*)</span></label>
                    <input type="number" class="form-control form-control" name="cccd" required>
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Số thẻ BHYT <span class="text-danger">(*)</span></label>
                    <input type="number" class="form-control form-control" name="bhyt" required>
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
                    <label class="largeInput">Người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control form-control" name="emergency_contact">
                </div>

                <div class="form-group col-3">
                    <label class="largeInput">Số điện thoại người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control form-control" name="emergency_contact_phone">
                </div>

                <div class="form-group col-6">
                    <label class="largeInput">Địa chỉ người liên hệ khẩn cấp</label>
                    <input type="text" class="form-control form-control" name="emergency_contact_address">
                </div>

                <div class="row">
                    <button type="submit" class="btn btn-success largeInput col-2"><i
                            class="fa fa-save mx-2"></i>Lưu</button>
                    <a class="btn btn-warning largeInput col-2 mx-2" href="{{ route('receptionist/patient') }}"><i
                            class="fa fa-arrow-left mx-2"></i>Trở về</a>
                </div>
            </div>
        </form>
    </div>
@endsection
