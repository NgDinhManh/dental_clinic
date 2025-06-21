@extends('layouts.master')

@section('content')
    <style>
        .a4-sheet {
            width: 794px;
            /* 210mm */
            min-height: 1123px;
            /* 297mm */
            background: white;
            padding: 40px;
            margin: auto;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            font-family: "Times New Roman", serif;
            font-size: 16px;
        }

        .a4-sheet h4,
        .a4-sheet h5,
        .a4-sheet p,
        .a4-sheet table th,
        .a4-sheet table td {
            font-family: "Times New Roman", serif;
        }

        .line {
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
        }

        .sect-title {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
    <div class="container">
        <div class="row">
            {{-- Sidebar --}}
            @include('layouts.patient_sidebar')

            {{-- Content --}}
            <div class="col-lg-9">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Hồ sơ khám chữa bệnh</h4>
                    </div>
                    <div class="card-body">
                        <div class="a4-print-area a4-sheet">
                            <div class="text-center mb-4">
                                <h4><strong>PHÒNG KHÁM NHA KHOA VINH</strong></h4>
                                <p>Số 12 Đường Trương Văn Lĩnh, Nghi Phú, TP.Vinh – SĐT: 0344 518 332</p>
                                <h5 class="mt-3"><strong>PHIẾU KHÁM BỆNH</strong></h5>
                            </div>

                            <!-- Thông tin bệnh nhân -->
                            <div class="row mb-2">
                                <div class="col-6">Họ và tên bệnh nhân: <strong>{{ $patient->fullname }}</strong></div>
                                <div class="col-3">Giới tính: <strong>{{ $patient->gender == 0 ? 'Nam' : 'Nữ' }}</strong>
                                </div>
                                <div class="col-3">Ngày sinh:
                                    <strong>{{ \Carbon\Carbon::parse($patient->birthday)->format('d/m/Y') }}</strong></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">Số CCCD: <strong>{{ $patient->cccd }}</strong></div>
                                <div class="col-6">Số điện thoại: <strong>{{ $patient->phone }}</strong></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">Địa chỉ: <strong>{{ $patient->address }}</strong></div>
                            </div>

                            <!-- Ngày khám -->
                            <div class="mb-2">Ngày khám:
                                <strong>{{ $medical_record->created_at->format('d/m/Y') }}</strong></div>

                            <!-- Triệu chứng và chẩn đoán -->
                            <div class="sect-title">I. TRIỆU CHỨNG & CHẨN ĐOÁN</div>
                            <p><strong>1. Triệu chứng: </strong> {{ $medical_record->symptoms }}</p>
                            <p><strong>2. Chẩn đoán: </strong> {{ $medical_record->diagnosis }}</p>

                            <!-- Dịch vụ thực hiện -->
                            <div class="sect-title">II. PHƯƠNG PHÁP ĐIỀU TRỊ</div>
                            <ul class="list-unstyled">
                                @foreach ($services as $service)
                                    <li>- {{ $service->service_name }}</li>
                                @endforeach
                            </ul>

                            <!-- Toa thuốc -->
                            <div class="sect-title">III. TOA THUỐC</div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên thuốc</th>
                                        <th>Liều dùng</th>
                                        <th>Số lượng</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($prescriptions))
                                        <tr>
                                            <td colspan="4" class="text-center">Không có toa thuốc nào.</td>
                                        </tr>
                                    @else
                                        @foreach ($prescriptions as $item)
                                            <tr>
                                                <td>{{ $item->medicine_name }}</td>
                                                <td>{{ $item->dosage }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->instructions }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            <!-- Ghi chú -->
                            <div class="sect-title">IV. GHI CHÚ</div>
                            <p>{{ $medical_record->notes }}</p>
                            <p>Bệnh nhân cần tái khám sau 7 ngày để kiểm tra tình trạng răng và hoàn tất điều trị.</p>

                            <!-- Ký tên -->
                            <div class="row mt-5">
                                <div class="col-6 text-center">
                                    <p><strong>Người bệnh</strong></p>
                                    <p class="mt-5">{{ $patient->fullname }}</p>
                                </div>
                                <div class="col-6 text-center">
                                    <p><strong>Bác sĩ điều trị</strong></p>
                                    <p class="mt-5">{{ $doctor->fullname }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
