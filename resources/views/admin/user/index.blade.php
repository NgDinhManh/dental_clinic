@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Người dùng</h3>
                                <a class="btn btn-success btn-round ms-auto" href="{{ route('admin/user/create') }}">
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
                                        <th>Avatar</th>
                                        <th>Tên người dùng</th>
                                        <th>Số điện thoại</th>
                                        <th>Vai trò</th>
                                        <th>Trạng thái</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->user_id }}</td>
                                            <td>
                                                <div class="avatar avatar-sm">
                                                    <img src="{{ asset('storage/images/avatar/' . $user->avatar) }}" alt="..."
                                                        class="avatar-img rounded-circle">
                                                </div>
                                            </td>
                                            <td> <a href="{{ route('admin/user/show', $user->user_id) }}"
                                                    class="text-primary">{{ $user->name }}</a></td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->role->description }}</td>
                                            <td>
                                                @if ($user->is_active == 1)
                                                    <span class="badge bg-success">Hoạt động</span>
                                                @else
                                                    <span class="badge bg-danger">Khóa</span>
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
                                                            <a href="{{ route('admin/user/show', $user->user_id) }}"
                                                                class="dropdown-item text-info">Xem</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin/user/edit', $user->user_id) }}"
                                                                class="dropdown-item text-primary">Chỉnh sửa</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admin/user/destroy', $user->user_id) }}"
                                                                class="d-flex align-items-center delete-form" method="POST"
                                                                id="delete-form-{{ $user->user_id }}">
                                                                @csrf @method('delete')
                                                                <button type="button"
                                                                    class="dropdown-item text-danger delete-button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#confirmDeleteModal"
                                                                    data-form-id="delete-form-{{ $user->user_id }}">
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
