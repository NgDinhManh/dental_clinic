@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thông tin bác sĩ</h4>
            </div>
            <div class="card-body row">

                <div class="form-group col-md-6">
                    <label class="fs-5">Họ và tên</label>
                    <input type="text" class="form-control form-control-lg" name="fullname" value="{{ $user->fullname }}">
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
                    <label class="fs-5">Chuyên môn</label>
                    <input type="text" class="form-control form-control-lg"
                        value="{{ $doctor->specialization }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Số năm kinh nghiệm</label>
                    <input type="number" class="form-control form-control-lg"
                        value="{{ $doctor->experience_years }}">
                </div>

                <div class="form-group col-md-12">
                    <label class="fs-5">Học vấn</label>
                    <input type="text" class="form-control form-control-lg"
                        value="{{ $doctor->education }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Bằng cấp chuyên môn</label><br>
                    <img id="previewCertification" src=" {{ asset('storage/images/' . $doctor->certification) }} "
                        alt="Xem trước ảnh" class="img-thumbnail shadow-sm rounded" style="max-width: 200px;">
                    <div class="form-group text-center mt-4">
                        <label class="image-upload-wrapper" for="image-upload-input">
                            <img id="image-upload-preview" src="{{ asset('storage/images/service/' . $service->image) }}"
                                class="image-upload img-thumbnail shadow-sm rounded" alt="Service Image Preview">
                        </label>
                        <input type="file" id="image-upload-input" name="image" accept="image/*"><br>
                        <label class="fs-5">Ảnh dịch vụ</label>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="fs-5">Giấy phép hành nghề</label><br>
                    <img id="previewLicense" src=" {{ asset('storage/images/' . $doctor->license) }} " alt="Xem trước ảnh"
                        class="img-thumbnail shadow-sm rounded" style="max-width: 200px;">
                </div>

                <div class="form-group col-md-12">
                    <label class="fs-5">Ghi chú</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $doctor->note }}">
                </div>

                <div class="row">
                    <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/doctor') }}"><i
                            class="fa fa-arrow-left mx-2"></i>Trở về</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hiển thị ảnh xem trước khi tải ảnh lên
        document.getElementById("certificationInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    var previewImage = document.getElementById("previewCertification");
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Hiển thị ảnh xem trước khi tải ảnh lên
        document.getElementById("licenseInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    var previewImage = document.getElementById("previewLicense");
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
