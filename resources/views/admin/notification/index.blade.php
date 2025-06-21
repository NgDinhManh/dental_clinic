@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Thông báo</h3>
                                <a class="btn btn-success btn-round ms-auto" href="{{ route('admin/notification/create') }}">
                                    <i class="fa fa-plus"></i>
                                    Thêm
                                </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr> 
                                        <th>#</th>
                                        <th>Tiêu đề</th>
                                        <th>Người nhận</th>
                                        <th>Trạng thái</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notificationss as $notification)
                                        <tr>
                                            <td>{{ $notification->notification_id }}</td>
                                            <td> {{ $notification->title }}</td>
                                            <td> {{ $notification->user->fullname }}</td>
                                            <td>
                                                @if($notification->is_read == 1)
                                                    <span class="badge badge-success fs-6 px-3">Đã đọc</span>
                                                @else
                                                    <span class="badge badge-warning fs-6 px-3">Chưa đọc</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin/notification/show', $notification->notification_id) }}"
                                                                class="dropdown-item text-primary">Xem</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-primary" href="{{ route('admin/notification/edit', $notification->notification_id) }}">
                                                                Chỉnh sửa
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admin/notification/destroy', $notification->notification_id) }}" method="POST">
                                                                @csrf @method('delete')
                                                                <button type="submit" class="dropdown-item text-danger"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa thông báo này không?')">
                                                                    Xóa
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection