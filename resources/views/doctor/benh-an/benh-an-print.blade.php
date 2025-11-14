<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>In Phiếu Khám</title>
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
            padding: 20px;
        }

        .a4-sheet {
            width: 794px;
            /* 210mm */
            min-height: 1123px;
            /* 297mm */
            background: white;
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
</head>

<body onload="window.print()" class="a4-sheet">
    <div class="text-center mb-4">
        <h4><strong>PHÒNG KHÁM NHA KHOA VINH</strong></h4>
        <p>Số 12 Đường Trương Văn Lĩnh, Nghi Phú, TP.Vinh – SĐT: 0344 518 332</p>
        <h5 class="mt-3"><strong>PHIẾU KHÁM BỆNH</strong></h5>
    </div>

    <!-- Thông tin bệnh nhân -->
    <div class="row mb-2">
        <div class="col-6">Họ và tên bệnh nhân: <strong>{{ $patient->fullname }}</strong></div>
        <div class="col-3">Giới tính: <strong>{{ $patient->gender }}</strong></div>
        <div class="col-3">Ngày sinh: <strong>{{ Carbon\Carbon::parse($patient->birthday)->format('d/m/Y') }}</strong></div>
    </div>
    <div class="row mb-2">
        <div class="col-6">Số CCCD: <strong>{{ $patient->cccd }}</strong></div>
        <div class="col-6">Số điện thoại: <strong>{{ $patient->phone }}</strong></div>
    </div>
    <div class="row mb-2">
        <div class="col-12">Địa chỉ: <strong>{{ $patient->address }}</strong></div>
    </div>

    <!-- Ngày khám -->
    <div class="mb-2">Ngày khám: <strong>{{ $medical_record->created_at->format('d/m/Y') }}</strong></div>

    <!-- Triệu chứng và chẩn đoán -->
    <div class="section-title">I. TRIỆU CHỨNG & CHẨN ĐOÁN</div>
    <p><strong>1. Triệu chứng: </strong>{{ $medical_record->symptoms }}</p>
    <p><strong>2. Chẩn đoán: </strong>{{ $medical_record->diagnosis }}</p>

    <!-- Dịch vụ thực hiện -->
    <div class="section-title">II. PHƯƠNG PHÁP ĐIỀU TRỊ</div>
    <p class="treatment-content">{{ $medical_record->treatment_plan }}</p>

    <!-- Toa thuốc -->
    <div class="section-title">III. TOA THUỐC</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên thuốc</th>
                <th>Liều lượng</th>
                <th>Số lượng</th>
                <th>Cách dùng</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($prescription_details))
                <tr>
                    <td colspan="4" class="text-center">Không có toa thuốc nào.</td>
                </tr>
            @else
                @foreach ($prescription_details as $item)
                    <tr>
                        <td>{{ $item->medicine_name }}</td>
                        <td>{{ $item->dosage }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->instruction }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    @if (!empty($prescription))
        <p><strong>Lưu ý sử dụng thuốc:</strong></p>
        <p class="treatment-content">{{ $prescription->notes }}</p>
    @endif

    <!-- Ghi chú -->
    <div class="section-title">IV. GHI CHÚ</div>
    <p>{{ $medical_record->notes }}</p>
    <p>Bệnh nhân cần tái khám sau 7 ngày để kiểm tra tình trạng răng và hoàn tất điều trị.</p>

    <!-- Ký tên -->
    <div class="row mt-3">
        <div class="col-6 text-center">
            <p><strong>Người bệnh</strong></p>
            <p class="mt-5">{{ $patient->fullname }}</p>
        </div>
        <div class="col-6 text-center">
            <p><strong>Bác sĩ điều trị</strong></p>
            <p class="mt-5">{{ $doctor->fullname }}</p>
        </div>
    </div>
</body>

</html>
