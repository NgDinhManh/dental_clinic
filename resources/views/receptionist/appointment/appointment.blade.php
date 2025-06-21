@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Lịch khám</h3>
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
                                        <th>Thời gian khám</th>
                                        <th>Dịch vụ</th>
                                        <th>Trạng thái</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->appointment_id }}</td>
                                            @php $patient = $patients->where('userid', $appointment->patient_id)->first(); @endphp
                                            <td>{{ $patient->fullname }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') . ' | ' . $appointment->appointment_time }}
                                            </td>
                                            @php $service_ids = $appointment_services->where('appointment_id', $appointment->appointment_id)->pluck('service_id');  @endphp
                                            <td class="text-truncate" style="max-width: 250px;"> @foreach ($services->whereIn('service_id', $service_ids) as $service)
                                                {{ $service->service_name . ', ' }}
                                            @endforeach </td>
                                            <td><span
                                                    class="badge
                                                        @if ($appointment->status == 'Chờ khám') bg-warning text-dark
                                                        @elseif($appointment->status == 'Đã khám') bg-success
                                                        @elseif($appointment->status == 'Đã hủy') bg-danger
                                                        @elseif($appointment->status == 'Quá hẹn') bg-secondary @endif
                                                    fs-6">
                                                    {{ $appointment->status }}
                                                </span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                        <a href="{{ route('receptionist/appointment/show', $appointment->appointment_id) }}"
                                                            class="dropdown-item text-info">Xem</a>
                                                        </li>
                                                        @if ($appointment->status == 'Chờ khám')
                                                        <li>
                                                            <a href="{{ route('receptionist/appointment/edit', $appointment->appointment_id) }}"
                                                                class="dropdown-item text-primary">Chỉnh sửa</a>
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
