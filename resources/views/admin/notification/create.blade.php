@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Thêm thông báo</h4>
        </div>
        <form action="{{ route('admin/notification/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="fs-5 mb-3">
                <label for="receiver_id" class="form-label">Người nhận</label>
                <select name="receiver_id" id="receiver_id" class="form-select form-control-lg">
                    <option value="">---</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->userid }}">{{ $user->fullname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="fs-5 mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control form-control-lg" id="title" name="title" required>
            </div>

            <div class="fs-5 mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea class="form-control form-control-lg" id="content" name="content" rows="8" required></textarea>
            </div>
            <div class="fs-5 mb-3">
                <label for="is_read" class="form-label">Trạng thái</label>
                <select name="is_read" id="is_read" class="form-select form-control-lg">
                    <option value="1" >Đã đọc</option>
                    <option value="0" selected>Chưa đọc</option>
                </select>
            </div>
            <div class="fs-5 mb-3">
                <label for="is_deleted" class="form-label">Xóa</label>
                <select class="form-select form-control-lg" id="is_deleted" name="is_deleted">
                    <option value="1" >Có</option>
                    <option value="0" selected>Không</option>
                </select>
            </div>
            <div class="row">
                <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ url()->previous() }}"><i
                        class="fa fa-arrow-left mx-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success fs-5 col-2"><i class="fa fa-save mx-2"></i>Lưu</button>
            </div>
        </form>
    </div>
@endsection
