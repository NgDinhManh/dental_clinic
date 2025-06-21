@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Chỉnh sửa câu hỏi thường gặp</h4>
        </div>
        <form action="{{ route('admin/message/update', $message->message_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="question" class="form-label">Câu hỏi</label>
                <textarea type="text" class="form-control" id="question" name="question" rows="8" required> {{ $message->question }}</textarea>
            </div>
            <div class="mb-3">
                <label for="answer" class="form-label">Câu trả lời</label>
                <textarea class="form-control" id="answer" name="answer" rows="8" required>{{ $message->answer }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select" id="is_active" name="is_active">
                    <option value="1" {{ $message->status == 1 ? 'selected' : '' }}>Hiện</option>
                    <option value="0" {{ $message->status == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="sort_order" class="form-label">Thứ tự</label>
                <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ $message->sort_order }}">
            </div>
            <div class="row">
                <button type="submit" class="btn btn-success fs-5 col-2"><i class="fa fa-save mx-2"></i>Lưu</button>
                <a class="btn btn-warning fs-5 col-2 mx-2" href="{{route('admin/message')}}"><i class="fa fa-arrow-left mx-2"></i>Trở về</a>
            </div>
        </form>
    </div>  
@endsection