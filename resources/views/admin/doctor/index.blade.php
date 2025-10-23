@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Bác sĩ</h3>
                                <a class="btn btn-success btn-round ms-auto" href="{{ route('admin/doctor/create') }}">
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
                                        <th>Họ và tên</th>
                                        <th>Chuyên môn</th>
                                        <th>Năm kinh nghiệm</th>
                                        <th>Học vấn</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                        <tr>
                                            <td>{{ $doctor->doctor_id }}</td>
                                            <td> <a href="{{ route('admin/doctor/show', $doctor->doctor_id) }}"
                                                    class="text-primary">{{ $doctor->user->fullname }}</a></td>
                                            <td>{{ $doctor->specialization }}</td>
                                            <td>{{ $doctor->experience_years }}</td>
                                            <td>{{ $doctor->education }}</td>
                                            <td>
                                                <form action="{{ route('admin/doctor/destroy', $doctor->doctor_id) }}"
                                                    method="POST" class="d-flex align-items-center delete-form"
                                                    id="delete-form-{{ $doctor->doctor_id }}">
                                                    @csrf @method('delete')
                                                    <a class="btn btn-link btn-primary btn-lg"
                                                        href="{{ route('admin/doctor/edit', $doctor->doctor_id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-link btn-danger delete-button"
                                                        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                        data-form-id="delete-form-{{ $doctor->doctor_id }}">
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
