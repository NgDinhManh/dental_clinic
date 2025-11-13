@extends('layouts.doctor')

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
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $record->patient->fullname }}</td>
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
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('doctor/benh-an/benh-an/show', $record->record_id) }}"
                                                                class="dropdown-item text-info">Xem</a>
                                                        </li>
                                                        @if ($record->status == 'Đang điều trị')
                                                            <li>
                                                                <a class="dropdown-item text-primary" href="{{ route('doctor/benh-an/benh-an/edit', $record->record_id) }}">
                                                                    Chỉnh sửa
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item text-success" href="{{ route('doctor/benh-an/benh-an/hoan-tat', $record->record_id) }}"
                                                                onclick="return confirm('Bạn có chắc chắn muốn hoàn tất bệnh án này?\nBệnh án sẽ không thể chỉnh sửa được nữa!')">
                                                                    Hoàn tất
                                                                </a>
                                                            </li>
                                                            @if (empty($prescriptions->where('record_id', $record->record_id)->first()))
                                                                <li>
                                                                    <a class="dropdown-item text-warning" href="{{ route('doctor/don-thuoc/don-thuoc-create', $record->record_id) }}">
                                                                        Đơn thuốc
                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <a class="dropdown-item text-warning" href="{{ route('doctor/don-thuoc/don-thuoc-edit', $record->record_id) }}">
                                                                        Đơn thuốc
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @else
                                                            <li>
                                                                <a class="dropdown-item text-primary" href="{{ route('doctor/benh-an/benh-an-reopen', $record->record_id) }}">
                                                                    Yêu cầu mở lại
                                                                </a>
                                                            </li>
                                                        @endif
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
