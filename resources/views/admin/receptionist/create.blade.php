@extends('layouts.admin')

@section('content')
<div class="page-inner">
    <form action="{{ route('admin/receptionist/store') }}" method="POST" class="card p-4 row">
        @csrf
        <h4 class="card-title">Thông tin tiếp tân</h4>

        <div class="form-group">
            <label class="fs-5">Họ và tên</label>
            <select name="receptionist_id" class="form-select form-control-lg" required>
                @foreach ($users as $user)
                    <option value="{{ $user->user_id }}">{{ $user->fullname }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="fs-5">Ngày bắt đầu làm việc</label>
            <input type="date" class="form-control form-control-lg" name="start_date" required>
        </div>

        <div class="form-group">
            <label class="fs-5">Ca làm việc</label>
            <select name="shift" class="form-control form-control-lg" required>
                <option value="Sáng">Sáng</option>
                <option value="Chiều">Chiều</option>
                <option value="Tối">Tối</option>
            </select>
        </div>

        <div class="form-group">
            <label class="fs-5">Ghi chú</label>
            <input type="text" class="form-control form-control-lg" name="note">
        </div>

        <div class="row">
            <button type="submit" class="btn btn-success fs-5 col-2"><i class="fa fa-save mx-2"></i>Lưu</button>
            <a class="btn btn-warning fs-5 col-2 mx-2" href="{{ route('admin/receptionist') }}"><i
                    class="fa fa-arrow-left mx-2"></i>Trở về</a>
        </div>
    </form>
</div>
@endsection
