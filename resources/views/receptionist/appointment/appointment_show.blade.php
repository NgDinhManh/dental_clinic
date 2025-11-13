@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Lịch khám chi tiết</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">
                            @if (isset($patient))
                                <input type="text" name="patient_id" value="{{ $patient->patient_id }}" hidden>

                                <!-- Row 1 -->
                                <div class="form-group col-md-4">
                                    <label for="fullname" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="fullname"
                                        value="{{ $patient->fullname }}" placeholder="Nguyễn Văn A">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        value="{{ $patient->user->email }}" placeholder="Nhập email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="phone"
                                        value="{{ $patient->user->phone }}">
                                </div>
                            @endif

                            <!-- Row 2 -->
                            <div class="form-group col-md-4">
                                <label for="appointment-date" class="form-label">Ngày khám</label>
                                <input type="text" class="form-control datepicker" id="appointment-date"
                                    name="appointment_date" value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}" required>
                            </div>
                            <div class="form-group col-md-8">
                                <label class="form-label">Khung giờ khám</label>
                                <input type="text" class="form-control datepicker" id="appointment-date"
                                        name="appointment_date" value="{{ $appointment->appointment_time }}" required>
                            </div>

                            <!-- Row 3 -->
                            <div class="form-group col-md-12">
                                <label for="service" class="form-label">Dịch vụ</label>
                                <div class="row p-3">
                                    @foreach ($appointment->appointment_services as $appointment_service)
                                    <div class="col-md-3 border p-2">
                                        {{ $appointment_service->service->service_name }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="notes" class="form-label">Ghi chú/Ghi chú yêu cầu</label>
                                <textarea class="form-control" name="notes" id="notes" rows="2"
                                    placeholder="Mô tả triệu chứng hoặc yêu cầu thêm..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-action text-center p-3">
                        <a href="{{ url()->previous() }}" class="btn btn-warning"><i></i>Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
