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
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $doctor->fullname }}</td>
                                            <td>{{ $doctor->specialization }}</td>
                                            <td>{{ $doctor->experience_years }}</td>
                                            <td>{{ $doctor->education }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis"></i>
                                                    </button>

                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin/doctor/show', $doctor->doctor_id) }}"
                                                                class="dropdown-item text-info">Xem</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin/doctor/edit', $doctor->doctor_id) }}"
                                                                class="dropdown-item text-primary">Chỉnh sửa</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admin/doctor/destroy', $doctor->doctor_id) }}"
                                                                class="d-flex align-items-center delete-form" method="POST"
                                                                id="delete-form-{{ $doctor->doctor_id }}">
                                                                @csrf @method('delete')
                                                                <button type="button"
                                                                    class="dropdown-item text-danger delete-button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#confirmDeleteModal"
                                                                    data-form-id="delete-form-{{ $doctor->doctor_id }}">
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
