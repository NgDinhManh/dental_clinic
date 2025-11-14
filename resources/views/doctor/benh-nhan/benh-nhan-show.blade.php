@extends('layouts.doctor')

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

        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .treatment-content {
            white-space: pre-line;
            word-break: break-word;
            overflow-wrap: break-word;
        }
    </style>

    <div class="text-center mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-warning" ><i class="fa fa-arrow-left me-2"></i>Trở lại</a>
    </div>

    <div class="a4-print-area a4-sheet">
        <div class="text-center mb-4">
            <h4><strong>PHÒNG KHÁM NHA KHOA VINH</strong></h4>
            <p>Số 12 Đường Trương Văn Lĩnh, Nghi Phú, TP.Vinh – SĐT: 0344 518 332</p>
        </div>

        <!-- Thông tin bệnh nhân -->
        <div class="section-title">I. THÔNG TIN BỆNH NHÂN</div>
        <div class="row mb-2">
            <div class="col-6">Họ và tên bệnh nhân: <strong>{{ $patient->fullname }}</strong></div>
            <div class="col-3">Giới tính: <strong>
                @if($patient->gender == 'Nam') Nam @elseif($patient->gender == 'Nữ') Nữ @else Khác @endif
            </strong></div>
            <div class="col-3">Ngày sinh: <strong>{{ Carbon\Carbon::parse($patient->birthday)->format('d/m/Y') }}</strong></div>
        </div>
        <div class="row mb-2">
            <div class="col-6">Số CCCD: <strong>{{ $patient->cccd }}</strong></div>
            <div class="col-6">Số điện thoại: <strong>{{ $patient->user->phone }}</strong></div>
        </div>
        <div class="row mb-2">
            <div class="col-12">Địa chỉ: <strong>{{ $patient->address }}</strong></div>
        </div>

        <!-- Triệu chứng và chẩn đoán -->
        <div class="section-title">II. THÔNG TIN Y TẾ</div>
        <p><strong>1. BHYT: </strong>{{ $patient->bhyt }}</p>
        <p><strong>2. Nhóm máu: </strong>{{ $patient->blood_type }}</p>
        <p><strong>3. Những bệnh lý mà bệnh nhân đã từng mắc: </strong>{{ $patient->medical_history }}</p>
        <p><strong>4. Tiền sử nha khoa: </strong>{{ $patient->dental_history }}</p>
        <p><strong>5. Thuốc mà bệnh nhân đang dùng: </strong>{{ $patient->current_medications }}</p>
        <p><strong>6. Lịch sử nha khoa: </strong>{{ $patient->dental_history }}</p>
        <p><strong>7. Người liên hệ khẩn cấp: </strong>{{ $patient->emergency_contact }}</p>
        <p><strong>8. Số điện thoại người liên hệ khẩn cấp: </strong>{{ $patient->emergency_contact_phone }}</p>
        <p><strong>9. Địa chỉ người liên hệ khẩn cấp: </strong>{{ $patient->emergency_contact_address }}</p>

    </div>

@endsection
