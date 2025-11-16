@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/message/update', $message->message_id) }}" class="card" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="card-header">
                <h4 class="page-title">Trả lời tin nhắn</h4>
            </div>

            <div class="card-body">
                <div class="row p-3">
                    <div class="form-group col-md-4">
                        <label for="name" class="form-label fs-5">Họ và tên</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name"
                            value="{{ $message->name }}" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone" class="form-label fs-5">Số điện thoại</label>
                        <input type="text" class="form-control form-control-lg" id="phone" name="phone"
                            value="{{ $message->phone }}" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email" class="form-label fs-5">Email</label>
                        <input type="text" class="form-control form-control-lg" id="email" name="email"
                            value="{{ $message->email }}" readonly>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="subject" class="form-label fs-5">Tiêu đề</label>
                    <input type="text" class="form-control form-control-lg" id="subject" name="subject"
                        value="{{ $message->subject }}" readonly>
                </div>

                <div class="form-group mb-3">
                    <label for="message" class="form-label fs-5">Nội dung</label>
                    <textarea type="text" class="form-control form-control-lg" id="message" name="message" rows="8" readonly> {{ $message->message }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="reply" class="form-label fs-5">Phản hồi</label>
                    <textarea class="form-control form-control-lg" id="reply" name="reply" rows="8" required>{{ $message->reply }}</textarea>
                </div>
            </div>

            <div class="card-action p-3 text-center">
                <a class="btn btn-warning me-2" href="{{ route('admin/message') }}"><i
                        class="fa fa-arrow-left me-2"></i>Trở về</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save me-2"></i>Lưu</button>
            </div>
        </form>
    </div>
@endsection
