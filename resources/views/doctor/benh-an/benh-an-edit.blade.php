@extends('layouts.doctor')

@php use Carbon\Carbon; @endphp

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .patient-info {
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .treatment-plan {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
        }
    </style>
    <div class="container-fluid">
        <form action="{{ route('doctor/benh-an/benh-an/update', $medical_record->record_id) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <!-- Cột thông tin bệnh nhân -->
                @if (isset($patient))
                    <div class="col-md-4 patient-info">
                        <!-- Header thông tin -->
                        <div class="d-flex align-items-center mb-4">
                            <div class="avatar avatar-xxl">
                                <img src="{{ asset('storage/images/' . $patient->avatar) }}"
                                    class="avatar-img rounded-circle me-3" alt="avatar">
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $patient->fullname }}</h4>
                                <p class="text-muted mb-0">ID: BN-{{ $patient->userid }}</p>
                                <p class="text-muted">
                                    {{ \Carbon\Carbon::parse($patient->birthday)->age . ' tuổi | ' }}
                                    @if ($patient->gender == '0')
                                        Nam
                                    @else
                                        Nữ
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Thông tin cơ bản -->
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                Thông tin cơ bản
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2">Ngày sinh:
                                        {{ Carbon::parse($patient->birthday)->format('d/m/Y') }}
                                    </li>
                                    <li class="mb-2">SĐT: {{ $patient->phone }}</li>
                                    <li class="mb-2">Địa chỉ: {{ $patient->address }}
                                    </li>
                                    <li class="mb-2">CCCD: {{ $patient->cccd }}</li>
                                    <li class="mb-2">BHYT: {{ $patient->bhyt }}</li>
                                    <li class="mb-2">Nhóm máu:
                                        {{ $patient->blood_type }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Tiền sử bệnh -->
                        <div class="card mb-3">
                            <div class="card-header bg-warning">
                                Tiền sử bệnh, nha khoa
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    @if ($patient->medical_history)
                                        <li><strong>Tiền sử bệnh: </strong>{{ $patient->medical_history }}</li>
                                    @else
                                        <li>Không có tiền sử bệnh</li>
                                    @endif

                                    @if ($patient->dental_history)
                                        <li><strong>Tiền sử nha khoa: </strong>{{ $patient->dental_history }}</li>
                                    @else
                                        <li>Không có tiền sử nha khoa</li>
                                    @endif
                                </ul>

                            </div>
                        </div>

                        <!-- Dị ứng -->
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                Dị ứng
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    @if ($patient->allergies)
                                        {{ $patient->allergies }}
                                    @else
                                        <p>Không có dị ứng</p>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif


                <!-- Cột nhập thông tin khám nha khoa -->
                <div class="col-md-8 medical-record">

                    <!-- Triệu chứng -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fa fa-clipboard2-pulse me-2"></i>Triệu chứng
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" name="symptoms" rows="3" placeholder="Mô tả triệu chứng chi tiết...">{{ $medical_record->symptoms }}</textarea>
                        </div>
                    </div>

                    <!-- Chẩn đoán -->
                    <div class="card mb-4">
                        <div class="card-header bg-warning">
                            <i class="fa fa-clipboard2-check me-2"></i>Chẩn đoán
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <textarea class="form-control" name="diagnosis" rows="3" placeholder="Ghi chú chẩn đoán...">{{ $medical_record->diagnosis }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chọn dịch vụ -->
                    <div class="card mb-4 service-selection">
                        <div class="card-header bg-success text-white">
                            <i class="fa fa-clipboard2-plus me-2"></i>Chọn dịch vụ
                        </div>
                        <div class="row mx-2">
                            @foreach ($services as $service)
                                <div class="form-check col-6">
                                    <input class="form-check-input" type="checkbox" name="services[{{ $loop->index + 1 }}]"
                                        value="{{ $service->service_id }}" id="service{{ $loop->index + 1 }}"
                                        @if (in_array($service->service_id, $medical_record_services))
                                            checked @endif>
                                    <label class="form-check-label" for="service{{ $loop->index + 1 }}">
                                        {{ $service->service_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Kế hoạch điều trị -->
                    <div class="card mb-4 treatment-plan">
                        <div class="card-body">
                            <h5 class="mb-3"><i class="fa fa-clipboard2-plus me-2"></i>Kế hoạch điều trị</h5>
                            <div class="col-12">
                                <textarea class="form-control" name="treatment_plan" rows="3" placeholder="Kế hoạch điều trị...">{{ $medical_record->treatment_plan }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Ghi chú cho bệnh nhân -->
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <i class="fa fa-chat-dots me-2"></i>Hướng dẫn sau điều trị
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" name="notes" rows="3" placeholder="Nhập hướng dẫn chăm sóc sau điều trị...">{{ $medical_record->notes }}</textarea>
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="my-4 text-start">
                        <a href="{{ url()->previous() }}" class="btn btn-lg btn-warning me-2">
                            <i class="fa fa-arrow-left me-2"></i>Trở lại
                        </a>
                        <button type="submit" class="btn btn-lg btn-primary me-2">
                            <i class="fa fa-save me-2"></i>Lưu bệnh án
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>

@endsection
