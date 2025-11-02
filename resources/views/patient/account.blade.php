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
                        <h4 class="mb-0">Thông tin tài khoản</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('patient/account/update', $user->user_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="row">

                                <div class="col-md-6 form-group mb-4">
                                    <label>Tên tài khoản</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                </div>

                                <div class="col-md-6 form-group mb-4">
                                    <label>Số điện thoại</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ $user->phone }}" readonly>
                                </div>

                                <div class="col-md-6 form-group mb-4">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                </div>

                                <div class="col-md-6 form-group mb-4">
                                    <label>Ảnh đại diện</label><br>
                                    <img id="previewImage" src=""
                                        alt="Xem trước ảnh" class="img-thumbnail shadow-sm rounded-circle d-none"
                                        style="width: 200px; height:200px; object-fit:cover;">
                                    <input type="file" class="form-control" id="imageInput" name="avatar"
                                        accept="image/*">
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
