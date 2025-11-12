@extends('layouts.doctor')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Bệnh nhân</h3>
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
                                        <th>Ngày sinh</th>
                                        <th>Số điện thoại</th>
                                        <th>BHYT</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $patient->fullname }}</a></td>
                                            <td>{{ $patient->birthday }}</td>
                                            <td>{{ $patient->user->phone }}</td>
                                            <td>{{ $patient->bhyt }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item text-info" href="{{ route('doctor/benh-nhan/benh-nhan/show', $patient->patient_id) }}">
                                                                Thông tin
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-primary" href="{{ route('doctor/benh-nhan/benh-nhan-benh-an', $patient->patient_id) }}">
                                                                Bệnh án
                                                            </a>
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
