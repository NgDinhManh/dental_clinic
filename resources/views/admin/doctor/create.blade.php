@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/doctor/store') }}" method="POST" class="card p-4 row" enctype="multipart/form-data">
            @csrf
            <h4 class="card-title">Thêm thông tin bác sĩ</h4>

            <div class="form-group">
                <label class="fs-5">Họ và tên</label>
                <select name="doctor_id" class="form-select form-control-lg" required>
                    @foreach ($users as $user)
                        <option value="0">Chọn tài khoản...</option>
                        <option value="{{ $user->user_id }}">{{ $user->fullname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="fs-5">Chuyên môn</label>
                <input type="text" class="form-control form-control-lg" name="specialization" required>
            </div>

            <div class="form-group">
                <label class="fs-5">Số năm kinh nghiệm</label>
                <input type="number" class="form-control form-control-lg" name="experience_years" required>
            </div>

            <div class="form-group">
                <label class="fs-5">Học vấn</label>
                <input type="text" class="form-control form-control-lg" name="education" required>
            </div>

            <div class="form-group">
                <label class="fs-5">Bằng cấp chuyên môn</label><br>
                <img id="previewCertification" src="#" alt="Xem trước ảnh"
                    class="img-thumbnail shadow-sm rounded d-none" style="max-width: 200px;">
                <input type="file" class="form-control form-control-lg" id="certificationInput" name="certification"
                    accept="image/*">
            </div>

            <div class="form-group">
                <label class="fs-5">Giấy phép hành nghề</label><br>
                <img id="previewLicense" src="#" alt="Xem trước ảnh" class="img-thumbnail shadow-sm rounded d-none"
                    style="max-width: 200px;">
                <input type="file" class="form-control form-control-lg" id="licenseInput" name="license"
                    accept="image/*">
            </div>

            <div class="form-group">
                <label class="fs-5">Ghi chú</label>
                <input type="text" class="form-control form-control-lg" name="note">
            </div>

            <div class="row">
                <button type="submit" class="btn btn-success fs-5 col-2"><i class="fa fa-save mx-2"></i>Lưu</button>
                <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/doctor') }}"><i
                        class="fa fa-arrow-left mx-2"></i>Trở về</a>
            </div>
        </form>
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
                    previewImage.classList.remove("d-none");
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
                    previewImage.classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
