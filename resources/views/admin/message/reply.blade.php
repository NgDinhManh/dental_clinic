@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <form action="{{ route('admin/message/update', $message->message_id) }}" class="card" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="card-header">
                <h4 class="page-title">Phản hồi tin nhắn</h4>
            </div>

            <div class="card-body row">
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

                <div class="form-group col-md-12">
                    <label for="subject" class="form-label fs-5">Tiêu đề</label>
                    <input type="text" class="form-control form-control-lg" id="subject" name="subject"
                        value="{{ $message->subject }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label fs-5">Nội dung</label>
                    <textarea type="text" class="form-control form-control-lg" id="message" name="message" rows="8" readonly> {{ $message->message }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="reply" class="form-label fs-5">Phản hồi</label>
                    <textarea class="form-control form-control-lg" id="reply" name="reply" rows="8" required>{{ $message->reply }}</textarea>
                </div>

                <div class="row">
                    <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ url()->previous() }}"><i
                            class="fa fa-arrow-left mx-2"></i>Trở về</a>
                    <button type="submit" class="btn btn-success fs-5 col-2"><i class="fa fa-save mx-2"></i>Lưu</button>
                </div>
            </div>
        </form>
    </div>
@endsection
