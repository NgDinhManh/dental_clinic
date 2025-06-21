@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Chỉnh sửa câu hỏi thường gặp</h4>
        </div>
        <div class="page-content">
            <div class="mb-3">
                <label for="question" class="form-label">Câu hỏi</label>
                <textarea type="text" class="form-control" id="question" name="question" rows="8"> {{ $faq->question }}</textarea>
            </div>
            <div class="mb-3">
                <label for="answer" class="form-label">Câu trả lời</label>
                <textarea class="form-control" id="answer" name="answer" rows="8">{{ $faq->answer }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select" id="is_active" name="is_active">
                    <option value="1" {{ $faq->status == 1 ? 'selected' : '' }}>Hiện</option>
                    <option value="0" {{ $faq->status == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="sort_order" class="form-label">Thứ tự</label>
                <input type="text" class="form-control" id="sort_order" name="sort_order" value="{{ $faq->sort_order }}">
            </div>
            <div class="row">
                <a class="btn btn-warning fs-5 col-2 mx-2" href="{{route('admin/faq')}}"><i class="fa fa-arrow-left mx-2"></i>Trở về</a>
            </div>
        </div>
    </div>
@endsection