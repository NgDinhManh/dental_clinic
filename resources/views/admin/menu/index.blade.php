@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Menu</h3>
                                <a class="btn btn-success btn-round ms-auto" href="{{ route('admin/menu/create') }}">
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
                                        <th>Tên Menu</th>
                                        <th>Route Name</th>
                                        <th>Trạng thái</th>
                                        <th>Thứ tự</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menuss as $menu)
                                        <tr>
                                            <td>{{ $menu->menu_id }}</td>
                                            <td>{{ $menu->menu_name }}</td>
                                            <td>{{ $menu->route_name }}</td>
                                            <td>
                                                @if ($menu->is_active == 1)
                                                    <span class="badge badge-success">Hiển thị</span>
                                                @else
                                                    <span class="badge badge-danger">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>{{ $menu->menu_order }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis"></i>
                                                    </button>

                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item text-info"
                                                                href="{{ route('admin/menu/show', $menu->menu_id) }}">Xem</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-primary"
                                                            href="{{ route('admin/menu/edit', $menu->menu_id) }}">Chỉnh sửa</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admin/menu/destroy', $menu->menu_id) }}"
                                                                class="d-flex align-items-center delete-form" method="POST"
                                                                id="delete-form-{{ $menu->menu_id }}">
                                                                @csrf @method('delete')
                                                                <button type="button"
                                                                    class="dropdown-item text-danger delete-button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#confirmDeleteModal"
                                                                    data-form-id="delete-form-{{ $menu->menu_id }}">
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
