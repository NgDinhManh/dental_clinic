@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Thêm câu hỏi thường gặp</h4>
        </div>
        <form action="{{ route('admin/faq/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="fs-5 mb-3">
                <label for="question" class="form-label">Câu hỏi</label>
                <textarea type="text" class="form-control form-control-lg" id="question" name="question" rows="8" required></textarea>
            </div>
            <div class="fs-5 mb-3">
                <label for="answer" class="form-label">Câu trả lời</label>
                <textarea class="form-control form-control-lg" id="answer" name="answer" rows="8" required></textarea>
            </div>
            <div class="fs-5 mb-3">
                <label for="is_active" class="form-label">Trạng thái</label>
                <select class="form-select form-control-lg" id="is_active" name="is_active">
                    <option value="1" >Hiện</option>
                    <option value="0" >Ẩn</option>
                </select>
            </div>
            <div class="fs-5 mb-3">
                <label for="sort_order" class="form-label">Thứ tự</label>
                <input type="text" class="form-control form-control-lg" id="sort_order" name="sort_order">
            </div>
            <div class="row">
                <button type="submit" class="btn btn-success fs-5 col-2"><i class="fa fa-save mx-2"></i>Lưu</button>
                <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/faq') }}"><i
                        class="fa fa-arrow-left mx-2"></i>Trở về</a>
            </div>
        </form>
    </div>
@endsection
