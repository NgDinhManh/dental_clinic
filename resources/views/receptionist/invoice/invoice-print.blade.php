<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Phiếu Thanh Toán</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #invoice-print,
            #invoice-print * {
                visibility: visible;
            }

            #invoice-print {
                position: absolute;
                left: 0;
                top: 0;
                width: 148mm;
                height: 210mm;
            }
        }

        body {
            font-family: 'Times New Roman', serif;
        }

        .invoice-box {
            padding: 20px;
            margin: 0 auto;
            font-size: 16px;
            font-family: 'Times New Roman', sans-serif;
            line-height: 1.3;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table th,
        .invoice-box table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-family: 'Times New Roman', sans-serif;
        }

        .invoice-box h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            font-family: 'Times New Roman', sans-serif;
        }

        .invoice-box p,
        .invoice-box h5 {
            font-family: 'Times New Roman', sans-serif;
        }
    </style>
</head>

<body>
    <div id="invoice-print" class="invoice-box">

        <h2>PHIẾU THANH TOÁN</h2>

        <p><strong>Ngày lập:</strong> {{ date('d/m/Y', strtotime($invoice->created_at)) }}</p>

        <div class="row mb-2">
            <div class="col-5 mb-3"><strong>Họ tên:</strong> {{ $patient->fullname }}</div>
            <div class="col-3"><strong>Giới tính:</strong>
                @if ($patient->gender == 0)
                    Nam
                @elseif($patient->gender == 1)
                    Nữ
                @else
                    Khác
                @endif
            </div>
            <div class="col-4"><strong>Ngày sinh:</strong> {{ date('d/m/Y', strtotime($patient->birthday)) }}</div>
            <div class="col-6 mb-3"><strong>SĐT:</strong> {{ $patient->phone }}</div>
            <div class="col-6"><strong>Email:</strong> {{ $patient->email }}</div>
            <div class="col-12"><strong>Địa chỉ:</strong> {{ $patient->address }}</div>
        </div>

        <hr>

        <h4 class="fw-bold mb-2">Dịch vụ sử dụng:</h4>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dịch vụ</th>
                    <th>Giá tiền (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medical_record_services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->service_name }}</td>
                        <td>{{ number_format($service->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>

        <table>
            <tr>
                <td><strong>Tổng tiền:</strong></td>
                <td>{{ number_format($invoice->total_amount, 0, ',', '.') }} VNĐ</td>
            </tr>
            <tr>
                <td><strong>Chi phí khác:</strong></td>
                <td>{{ number_format($invoice->other_fee, 0, ',', '.') }} VNĐ</td>
            </tr>
            <tr>
                <td><strong>Chi tiết chi phí khác:</strong></td>
                <td>{{ $invoice->other_fee_detail }}</td>
            </tr>
            <tr>
                <td><strong>Giảm giá:</strong></td>
                <td>{{ number_format($invoice->discount, 0, ',', '.') }} VNĐ</td>
            </tr>
            <tr>
                <td><strong>Tổng tiền phải trả:</strong></td>
                <td><strong>{{ number_format($invoice->final_amount, 0, ',', '.') }} VNĐ</strong></td>
            </tr>
            <tr>
                <td><strong>Phương thức thanh toán:</strong></td>
                <td>{{ $invoice->payment_method }}</td>
            </tr>
            <tr>
                <td><strong>Trạng thái:</strong></td>
                <td>{{ $invoice->status }}</td>
            </tr>
        </table>

        <br><br>

        <div style="text-align: center;">
            <em>Người lập phiếu</em><br><br><br>
            <p>
                {{ $invoice->receptionist->user->fullname ?? 'Không xác định' }}
            </p>
        </div>

    </div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
