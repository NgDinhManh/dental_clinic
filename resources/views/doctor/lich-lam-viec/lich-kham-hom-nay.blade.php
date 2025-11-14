@extends('layouts.doctor')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Lịch khám hôm nay</h3>
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
                                        <th>Thời gian</th>
                                        <th>Dịch vụ</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>{{ $appointment->appointment_id }}</td>
                                            <td>{{ $appointment->patient->fullname }}</a></td>
                                            <td>{{ $appointment->appointment_time . ' | ' . \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                                            <td class="text-truncate" style="max-width: 220px;">
                                                @foreach ($appointment_services as $appointment_service)
                                                    @if ($appointment_service->appointment_id == $appointment->appointment_id)
                                                        {{ $services->where('service_id', $appointment_service->service_id)->first()->service_name , ', ' }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td><span class="badge
                                                        @if ($appointment->status == 'Chờ khám') bg-warning text-dark
                                                        @elseif($appointment->status == 'Đã khám') bg-success
                                                        @elseif($appointment->status == 'Đã hủy') bg-danger
                                                        @elseif($appointment->status == 'Quá hẹn') bg-secondary @endif
                                                    fs-6"> {{ $appointment->status }}
                                                </span></td>
                                            <td>
                                                @if ($appointment->status == 'Chờ khám')
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('doctor/lich-lam-viec/kham-benh-lich', $appointment->appointment_id) }}">
                                                    Khám
                                                </a>
                                                <a class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy lịch hẹn này không?')"
                                                    href="{{ route('doctor/lich-lam-viec/kham-benh-lich-huy', $appointment->appointment_id) }}">
                                                    Hủy
                                                </a>
                                                @endif
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
