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
                                        <th>Tên người dùng</th>
                                        <th>Email</th>
                                        <th>Vai trò</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->userid }}</td>
                                            <td> <a href="{{ route('admin/user/show', $user->userid) }}"
                                                    class="text-primary">{{ $user->name }}</a></td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role->description }}</td>
                                            <td>
                                                <form action="{{ route('admin/user/destroy', $user->userid) }}"
                                                    method="POST" class="d-flex align-items-center delete-form"
                                                    id="delete-form-{{ $user->userid }}">
                                                    @csrf @method('delete')
                                                    <a class="btn btn-link btn-primary btn-lg"
                                                        href="{{ route('admin/user/edit', $user->userid) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-link btn-danger delete-button"
                                                        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                        data-form-id="delete-form-{{ $user->userid }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal Xác Nhận Xóa -->
                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn xóa mục này không?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            let deleteFormId = '';

                            // Lắng nghe sự kiện khi click vào nút xóa
                            document.querySelectorAll('.delete-button').forEach(button => {
                                button.addEventListener('click', function() {
                                    deleteFormId = this.getAttribute('data-form-id');
                                });
                            });

                            // Khi nhấn nút "Xóa" trong modal
                            document.getElementById('confirmDeleteButton').addEventListener('click', function() {
                                if (deleteFormId) {
                                    document.getElementById(deleteFormId).submit();
                                }
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection
