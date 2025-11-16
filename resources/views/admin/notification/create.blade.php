@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/notification/store') }}" method="POST" class="card"
            enctype="multipart/form-data">
            @csrf

            <div class="card-header">
                <h4 class="card-title">Thêm thông báo</h4>
            </div>

            <div class="card-body">
                <div class="row p-3">
                    <div class="form-group col-md-4">
                        <label for="receiver_id" class="form-label fs-5">Người nhận</label>
                        <select name="receiver_id" id="receiver_id" class="form-select form-control-lg">
                            <option value="">Chọn người nhận</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="is_read" class="form-label fs-5">Trạng thái đọc</label>
                        <select name="is_read" id="is_read" class="form-select form-control-lg">
                            <option value="1" >Đã đọc</option>
                            <option value="0" selected>Chưa đọc</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="is_deleted" class="form-label fs-5">Trạng thái xóa</label>
                        <select class="form-select form-control-lg" id="is_deleted" name="is_deleted">
                            <option value="1" >Có</option>
                            <option value="0" selected>Không</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="title" class="form-label fs-5">Tiêu đề</label>
                    <input type="text" class="form-control form-control-lg" id="title" name="title">
                </div>

                <div class="form-group mb-3">
                    <label for="content" class="form-label fs-5">Nội dung</label>
                    <textarea class="form-control form-control-lg" id="content" name="content" rows="8"></textarea>
                </div>

            </div>

            <div class="card-action p-3 text-center">
                <a class="btn btn-warning me-2" href="{{ route('admin/notification') }}">
                    <i class="fa fa-arrow-left me-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save me-2"></i>Lưu</button>
            </div>
        </form>
    </div>
@endsection
