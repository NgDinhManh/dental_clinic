@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/notification/update', $notification->notification_id) }}" method="POST" class="card"
            enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="card-header">
                <h4 class="card-title">Chỉnh sửa thông báo</h4>
            </div>

            <div class="card-body">
                <div class="row p-3">
                    <div class="form-group col-md-4">
                        <label for="receiver_id" class="form-label">Người nhận</label>
                        <select class="form-select form-control-lg" id="receiver_id" name="receiver_id">
                            <option value="">Chọn người nhận</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}" {{ $notification->receiver_id == $user->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="is_read" class="form-label">Trạng thái đọc</label>
                        <select class="form-select form-control-lg" id="is_read" name="is_read">
                            <option value="1" {{ $notification->is_read == 1 ? 'selected' : '' }}>Đã đọc</option>
                            <option value="0" {{ $notification->is_read == 0 ? 'selected' : '' }}>Chưa đọc</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="is_deleted" class="form-label">Trạng thái xóa</label>
                        <select class="form-select form-control-lg" id="is_deleted" name="is_deleted">
                            <option value="1" {{ $notification->is_deleted == 1 ? 'selected' : '' }}>Có</option>
                            <option value="0" {{ $notification->is_deleted == 0 ? 'selected' : '' }}>Không</option>
                        </select>
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
                <button type="submit" class="btn btn-success"><i class="fa fa-save me-2"></i>Lưu</button>
            </div>
        </form>
    </div>
@endsection
