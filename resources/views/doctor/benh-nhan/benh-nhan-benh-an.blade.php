@extends('layouts.doctor')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Bệnh án của bệnh nhân: {{ $patient->fullname }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bệnh nhân</th>
                                        <th>Ngày khám</th>
                                        <th>Chuẩn đoán</th>
                                        <th>Trạng thái</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medical_records as $medical_record)
                                        <tr>
                                            <td>{{ $medical_record->record_id }}</td>
                                            <td>{{ $patient->fullname }}</a></td>
                                            <td>{{ $medical_record->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $medical_record->diagnosis }}</td>
                                            <td>
                                                <span class="badge
                                                        @if ($medical_record->status == 'Đang điều trị') bg-warning text-dark
                                                        @elseif($medical_record->status == 'Hoàn tất') bg-success @endif
                                                    fs-6"> {{ $medical_record->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a class="btn btn-link btn-primary btn-lg"
                                                    href="{{ route('doctor/benh-an/benh-an/show', $medical_record->record_id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
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
