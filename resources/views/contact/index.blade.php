@extends('layouts.master')

@section('content')
    <h1>Liên hệ với chúng tôi</h1>
    <form action="" method="POST">
        <h2>Title: Tiêu đề</h2>
        <input type="text" name="name" placeholder="Họ và tên">
        <input type="email" name="email" placeholder="Email">
        <textarea name="message" placeholder="Nhập câu hỏi của bạn"></textarea>
        <button type="submit">Gửi</button>


        {{-- @foreach ($myphone as $phone)
            <h3>{{$phone}}</h3>
        @endforeach --}}

        {{-- <a href="{{route('home')}}">Link to contact</a> --}}

        {{-- <h3>{{route('showRoute')}}</h3>  --}}
    </form>
    {{ $x = 2 }}
    @if ($x < 5)
        <h3>Xin chào Mạnh</h3>
    @endif

    @unless (1>>2)
        <h3>Điều này không xảy ra</h3>
    @endunless
    {{$myphone = '';}}
    @empty($myphone)
        <h3>Không có số điện thoại nào</h3>
    @endempty

    @isset($record)
        <h3>Biến record đã được khởi tạo</h3>
        
    @endisset


@endsection
