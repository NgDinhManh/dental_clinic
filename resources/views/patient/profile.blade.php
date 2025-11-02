@extends('layouts.master')

@section('content')
    <div class="container">

        <div class="row">
            {{-- Sidebar --}}
            @include('layouts.patient_sidebar')

            {{-- Content --}}
            <div class="col-lg-9">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">Thông tin hồ sơ</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('patient/profile/update', $user->user_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf @method('PUT')

                            <div class="row">

                                <div class="col-md-6 row">
                                    <div class="form-group mb-4">
                                        <label>Họ và tên</label>
                                        <input type="text" class="form-control" name="fullname" value="{{ $patient->fullname }}" required>
                                    </div>

                                    <div class="col-md-6 form-group mb-4">
                                        <label>Giới tính</label>
                                        <select name="gender" class="form-select form-control">
                                            <option value="Nam" {{ $patient->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                                            <option value="Nữ" {{ $patient->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                            <option value="Khác" {{ $patient->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group mb-4">
                                        <label>Ngày sinh</label>
                                        <input type="date" class="form-control" name="birthday"
                                            value="{{ $patient->birthday }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Số điện thoại</label>
                                        <input type="tel" class="form-control" name="phone" value="{{ $user->phone }}" readonly>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control" name="address" value="{{ $patient->address }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>CCCD</label>
                                        <input type="text" class="form-control" name="cccd" value="{{ $patient->cccd }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>BHYT</label>
                                        <input type="text" class="form-control" name="bhyt" value="{{ $patient->bhyt }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Nhóm máu</label>
                                        <select name="blood_type" class="form-select form-control">
                                            <option value="A" {{ $patient->blood_type == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ $patient->blood_type == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="AB" {{ $patient->blood_type == 'AB' ? 'selected' : '' }}>AB</option>
                                            <option value="O" {{ $patient->blood_type == 'O' ? 'selected' : '' }}>O</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Dị ứng</label>
                                        <input type="text" class="form-control" name="allergies" value="{{ $patient->allergies }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Tiền sử y khoa</label>
                                        <input type="text" class="form-control" name="medical_history" value="{{ $patient->medical_history }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Tiền sử nha khoa</label>
                                        <input type="text" class="form-control" name="dental_history" value="{{ $patient->dental_history }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Thuốc đang sử dụng</label>
                                        <input type="text" class="form-control" name="current_medications" value="{{ $patient->current_medications }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Người liên hệ khẩn cấp</label>
                                        <input type="text" class="form-control" name="emergency_contact" value="{{ $patient->emergency_contact }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Số điện thoại người liên hệ khẩn cấp</label>
                                        <input type="text" class="form-control" name="emergency_contact_phone" value="{{ $patient->emergency_contact_phone }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Địa chỉ người liên hệ khẩn cấp</label>
                                        <input type="text" class="form-control" name="emergency_contact_address" value="{{ $patient->emergency_contact_address }}">
                                    </div>
                                </div>

                                <div class="col-md-2 form-group">
                                    <button type="submit" class="btn btn-primary w-100"><i
                                            class="fa-solid fa-rotate-right mx-2"></i>Cập
                                        nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Hiển thị ảnh xem trước khi tải ảnh lên
        document.getElementById("imageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    var previewImage = document.getElementById("previewImage");
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
