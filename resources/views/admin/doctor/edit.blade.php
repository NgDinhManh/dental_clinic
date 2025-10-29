@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/doctor/update', $doctor->doctor_id) }}" method="POST" class="card"
            enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="card-header">
                <h4 class="card-title">Sửa thông tin bác sĩ</h4>
            </div>

            <div class="card-body row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fs-5">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="fullname"
                            value="{{ $doctor->fullname }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Giới tính <span class="text-danger">*</span></label>
                        <select name="gender" class="form-control form-control-lg">
                            <option value="Nam" {{ $doctor->gender == 'Nam' ? 'selected' : ''}}>Nam</option>
                            <option value="Nữ" {{ $doctor->gender == 'Nữ' ? 'selected' : ''}}>Nữ</option>
                            <option value="Khác" {{ $doctor->gender == 'Khác' ? 'selected' : ''}}>Khác</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ngày sinh <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-lg" name="birthday"
                            value="{{ $doctor->birthday }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control form-control-lg" name="phone"
                            value="{{ $doctor->user->phone }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Địa chỉ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="address"
                            value="{{ $doctor->address }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Ghi chú</label>
                        <input type="text" class="form-control form-control-lg" name="note"
                            value="{{ $doctor->note }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fs-5">Chuyên môn <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="specialization"
                            value="{{ $doctor->specialization }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Số năm kinh nghiệm <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-lg" name="experience_years"
                            value="{{ $doctor->experience_years }}">
                    </div>

                    <div class="form-group">
                        <label class="fs-5">Học vấn <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="education"
                            value="{{ $doctor->education }}">
                    </div>

                    <div class="row">
                        <div class="form-group text-center mt-4 col-6">
                            <label class="image-upload-wrapper" for="image-upload-input-1">
                                <img data-preview style="width: 60vh;" src="{{ asset('storage/images/' . $doctor->certification) }}"
                                    class="image-upload img-thumbnail shadow-sm rounded" alt="Bằng cấp chuyên môn">
                            </label>
                            <input type="file" class="image-upload-input" id="image-upload-input-1" name="certification" accept="image/*"><br>
                            <label class="fs-5">Bằng cấp chuyên môn <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-group text-center mt-4 col-6">
                            <label class="image-upload-wrapper" for="image-upload-input-2">
                                <img data-preview style="width: 60vh;" src="{{ asset('storage/images/' . $doctor->license) }}"
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
