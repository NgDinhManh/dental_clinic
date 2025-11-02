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
                        <h4 class="mb-0">Đổi mật khẩu</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('patient/change-password-update', $user->user_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="row">
                                <div class="col-md-7 form-group mb-4">
                                    <label>Mật khẩu cũ</label>
                                    <input type="password" class="form-control" name="old_password">
                                </div>

                                <div class="col-md-7 form-group mb-4">
                                    <label>Mật khẩu mới</label>
                                    <input type="password" class="form-control" name="password">
                                </div>

                                <div class="col-md-7 form-group mb-4">
                                    <label>Nhập lại mật khẩu mới</label>
                                    <input type="password" class="form-control" name="confirm_password">
                                </div>
                                <div class="col-md-5"></div>

                                <div class="col-md-2 form-group">
                                    <button type="submit" class="btn btn-primary w-100"><i
                                            class="fa-solid fa-rotate-right me-2"></i>Cập
                                        nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
