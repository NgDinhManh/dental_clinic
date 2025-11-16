@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Thông tin thông báo</h4>
            </div>

            <div class="card-body">
                <div class="row p-3">
                    <div class="form-group col-md-4">
                        <label for="receiver_id" class="form-label">Người nhận</label>
                        <input type="text" class="form-control form-control-lg" value="{{ $notification->user->name }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="is_read" class="form-label">Trạng thái đọc</label>
                        <input type="text" class="form-control form-control-lg"
                            value="{{ $notification->is_read == 1 ? 'Đã đọc' : 'Chưa đọc' }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="is_deleted" class="form-label">Trạng thái xóa</label>
                        <input type="text" class="form-control form-control-lg"
                            value="{{ $notification->is_delete == 1 ? 'Có' : 'Không' }}">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ $notification->title }}">
                </div>

                <div class="form-group mb-3">
                    <label for="content" class="form-label">Nội dung</label>
                    <textarea class="form-control form-control-lg" id="content" name="content" rows="5" required>{{ $notification->content }}</textarea>
                </div>
            </div>

            <div class="card-action p-3 text-center">
                <a class="btn btn-warning me-2" href="{{ route('admin/notification') }}"><i class="fa fa-arrow-left me-2"></i>Trở về</a>
            </div>
        </div>
    </div>
@endsection
