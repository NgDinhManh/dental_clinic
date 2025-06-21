@extends('layouts.receptionist')

@section('content')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #invoice-print, #invoice-print * {
            visibility: visible;
        }
        #invoice-print {
            position: absolute;
            left: 0;
            top: 0;
            width: 148mm;
            height: 210mm;
            padding: 20px;
        }
    }

    .invoice-box {
        padding: 20px;
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

<div class="text-center mt-3">
    <a href="{{ route('receptionist/invoice/print', $invoice->invoice_id) }}" target="_blank" class="btn btn-success">In hóa đơn</a>
    <a href="{{ url()->previous() }}" class="btn btn-warning">Quay lại</a>
</div>

<div class="page-inner">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div id="invoice-print" class="invoice-box border shadow bg-white rounded">

                <h2>PHIẾU THANH TOÁN</h2>

                <p><strong>Ngày lập:</strong> {{ date('d/m/Y', strtotime($invoice->created_at)) }}</p>

                <div class="row mb-2">
                    <div class="col-6 mb-3"><strong>Họ tên:</strong> {{ $patient->fullname }}</div>
                    <div class="col-3"><strong>Giới tính:</strong> 
                        @if($patient->gender == 0) Nam 
                        @elseif($patient->gender == 1) Nữ 
                        @else Khác 
                        @endif
                    </div>
                    <div class="col-3"><strong>Ngày sinh:</strong> {{ date('d/m/Y', strtotime($patient->birthday)) }}</div>
                    <div class="col-6 mb-3"><strong>SĐT:</strong> {{ $patient->phone }}</div>
                    <div class="col-6"><strong>Email:</strong> {{ $patient->email }}</div>
                    <div class="col-12"><strong>Địa chỉ:</strong> {{ $patient->address }}</div>
                </div>

                <hr>

                <h5 class="fw-bold mb-2">Dịch vụ sử dụng:</h5>
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

        </div>
    </div>
</div>
@endsection
