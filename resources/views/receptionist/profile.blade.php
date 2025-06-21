@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <form action="{{ route('receptionist/update', $user->userid) }}" method="POST" class="card p-4" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <h4 class="card-title">Thông tin cá nhân</h4>

                <div class="col-md-6 form-group mb-4">
                    <label class="fs-5">Tên tài khoản</label>
                    <input type="text" class="form-control form-control-lg" name="name" value="{{ $user->name }}">
                </div>

                <div class="col-md-6 form-group mb-4">
                    <label class="fs-5">Họ và tên</label>
                    <input type="text" class="form-control form-control-lg" name="fullname" value="{{ $user->fullname }}">
                </div>

                <div class="col-md-3 form-group mb-4">
                    <label class="fs-5">Giới tính</label>
                    <select name="gender" class="form-select form-control form-control-lg">
                        <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Nam</option>
                        <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nữ</option>
                        <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>

                <div class="col-md-3 form-group mb-4">
                    <label class="fs-5">Ngày sinh</label>
                    <input type="date" class="form-control form-control-lg" name="birthday" value="{{ $user->birthday }}">
                </div>

                <div class="col-md-6 form-group mb-4">
                    <label class="fs-5">Số điện thoại</label>
                    <input type="tel" class="form-control form-control-lg" name="phone" value="{{ $user->phone }}">
                </div>

                <div class="col-md-6 form-group mb-4">
                    <label class="fs-5">Email</label>
                    <input type="email" class="form-control form-control-lg" name="email" value="{{ $user->email }}">
                </div>

                <div class="col-md-6 form-group mb-4">
                    <label class="fs-5">Địa chỉ</label>
                    <input type="text" class="form-control form-control-lg" name="address" value="{{ $user->address }}">
                </div>

                <div class="col-md-6 form-group mb-4">
                    <label class="fs-5">Ảnh đại diện</label><br>
                    <img id="previewImage" src="{{ asset('storage/images/' . $user->avatar) }}" alt="Xem trước ảnh"
                        class="img-thumbnail shadow-sm rounded" style="max-width: 200px;">
                    <input type="file" class="form-control form-control-lg mt-2" id="imageInput" name="avatar" accept="image/*">
                </div>

                <div class="col-md-6"></div>

                <div class="col-md-2 form-group mb-4">
                    <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-rotate-right mx-2"></i>Cập nhật</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Hiển thị ảnh xem trước khi tải ảnh lên
        document.getElementById("imageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById("previewImage");
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

