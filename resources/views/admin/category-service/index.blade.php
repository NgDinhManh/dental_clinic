@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Danh mục dịch vụ</h3>
                                <a class="btn btn-success btn-round ms-auto" href="{{ route('admin/category-service/create') }}">
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
                                        <th>Tên danh mục</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category_services as $category_service)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $category_service->category_name }}</td>
                                            <td>{{ $category_service->description }}</td>
                                            <td>
                                                @if($category_service->status == 'Có sẵn')
                                                    <span class="badge badge-success">Có sẵn</span>
                                                @else
                                                    <span class="badge badge-danger">Tạm ngưng</span>
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
                                                            <a href="{{ route('admin/category-service/show', $category_service->category_id) }}"
                                                                class="dropdown-item text-info">Xem</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin/category-service/edit', $category_service->category_id) }}"
                                                                class="dropdown-item text-primary">Chỉnh sửa</a>
                                                        </li>
                                                        <li>
                                                        <form action="{{ route('admin/category-service/destroy', $category_service->category_id) }}"
                                                            class="delete-form" method="POST"
                                                            id="delete-form-{{ $category_service->category_id }}">
                                                            @csrf @method('delete')
                                                            <button type="button"
                                                                class="dropdown-item text-danger delete-button"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirmDeleteModal"
                                                                data-form-id="delete-form-{{ $category_service->category_id }}">
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
