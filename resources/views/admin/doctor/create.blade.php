@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/doctor/store') }}" class="card" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-header">
                <h4 class="card-title">Thêm bác sĩ mới</h4>
            </div>

            <div class="card-body row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fs-5">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="fullname">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Giới tính <span class="text-danger">*</span></label>
                        <select name="gender" class="form-control form-control-lg">
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ngày sinh <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-lg" name="birthday">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control form-control-lg" name="phone">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Địa chỉ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="address">
                    </div>


                    <div class="form-group">
                        <label class="fs-5">Ghi chú</label>
                        <input type="text" class="form-control form-control-lg" name="note">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fs-5">Chuyên môn <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="specialization">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Số năm kinh nghiệm <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-lg" name="experience_years">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Học vấn <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="education">
                    </div>

                    <div class="row">
                        <div class="form-group text-center mt-4 col-6">
                            <label class="image-upload-wrapper" for="image-upload-input-1">
                                <img data-preview style="width: 60vh;" src="{{ asset('admin_assets/img/image_default.png') }}"
                                    class="image-upload img-thumbnail shadow-sm rounded" alt="Bằng cấp chuyên môn">
                            </label>
                            <input type="file" class="image-upload-input" id="image-upload-input-1" name="certification" accept="image/*"><br>
                            <label class="fs-5">Bằng cấp chuyên môn <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-group text-center mt-4 col-6">
                            <label class="image-upload-wrapper" for="image-upload-input-2">
                                <img data-preview style="width: 60vh;" src="{{ asset('admin_assets/img/image_default.png') }}"
                                    class="image-upload img-thumbnail shadow-sm rounded" alt="Bằng cấp chuyên môn">
                            </label>
                            <input type="file" class="image-upload-input" id="image-upload-input-2" name="license" accept="image/*"><br>
                            <label class="fs-5">Giấy phép hành nghề <span class="text-danger">*</span></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-action p-3 text-center">
                <a class="btn btn-warning mx-2" href="{{ route('admin/doctor') }}"><i class="fa fa-arrow-left pe-2"></i>Trở
                    về</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save pe-2"></i>Lưu</button>
            </div>
        </form>
    </div>
@endsection
