@extends('layouts.admin')

@section('content')
<div class="page-inner">
    <form action="{{ route('admin/doctor/update', $doctor->doctor_id) }}" method="POST" class="card p-4 row" enctype="multipart/form-data">
        @csrf @method('PUT')
        <h4 class="card-title">Sửa thông tin bác sĩ</h4>

        <div class="form-group">
            <label class="fs-5">Họ và tên</label>
            <input type="text" class="form-control form-control-lg" name="fullname" value="{{ $user->fullname }}" readonly>
        </div>

        <div class="form-group">
            <label class="fs-5">Chuyên môn</label>
            <input type="text" class="form-control form-control-lg" name="specialization" value="{{ $doctor->specialization }}">
        </div>

        <div class="form-group">
            <label class="fs-5">Số năm kinh nghiệm</label>
            <input type="number" class="form-control form-control-lg" name="experience_years" value="{{ $doctor->experience_years }}">
        </div>

        <div class="form-group">
            <label class="fs-5">Học vấn</label>
            <input type="text" class="form-control form-control-lg" name="education" value="{{ $doctor->education }}">
        </div>

        <div class="form-group">
            <label class="fs-5">Bằng cấp chuyên môn</label><br>
            <img id="previewCertification" src=" {{asset('storage/images/' . $doctor->certification)}} " alt="Xem trước ảnh" class="img-thumbnail shadow-sm rounded"
                style="max-width: 200px;">
            <input type="file" class="form-control form-control-lg" id="certificationInput" name="certification" accept="image/*">
        </div>

        <div class="form-group">
            <label class="fs-5">Giấy phép hành nghề</label><br>
            <img id="previewLicense" src=" {{asset('storage/images/' . $doctor->license)}} " alt="Xem trước ảnh" class="img-thumbnail shadow-sm rounded"
                style="max-width: 200px;">
            <input type="file" class="form-control form-control-lg" id="licenseInput" name="license" accept="image/*">
        </div>

        <div class="form-group">
            <label class="fs-5">Ghi chú</label>
            <input type="text" class="form-control form-control-lg" name="note" value="{{ $doctor->note }}">
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
