@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title
                                ">Bệnh án</h3>
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
                                    @foreach ($medical_records as $record)
                                        <tr>
                                            <td>{{ $record->record_id }}</td>
                                            <td> <a href="{{ route('doctor/benh-an/benh-an/show', $record->record_id) }}"
                                                    class="text-primary">{{ $patients->where('patient_id', $record->patient_id)->first()->fullname }}</a>
                                            </td>
                                            <td>{{ $record->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $record->diagnosis }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                                        @if ($record->status == 'Đang điều trị') bg-warning text-dark
                                                        @elseif($record->status == 'Hoàn tất') bg-success @endif
                                                    fs-6">
                                                    {{ $record->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                    <i class="fa fa-ellipsis"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item text-primary"
                                                            href="{{ route('admin/doctor/benh-an-show', $record->record_id) }}">
                                                            Xem
                                                        </a>
                                                    </li>
                                                    @if ($record->status == 'Hoàn tất')
                                                        <li>
                                                            <a class="dropdown-item text-success"
                                                                href="{{ route('admin/doctor/benh-an-reopen', $record->record_id) }}"
                                                                onclick="return confirm('Bạn có chắc chắn muốn mở lại bệnh án này?')">
                                                                Mở lại
                                                        </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger"
                                                                href="{{ route('admin/doctor/benh-an-decline', $record->record_id) }}"
                                                                onclick="return confirm('Bạn có chắc chắn muốn từ chối mở lại bệnh án này?')">
                                                                Từ chối
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
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
