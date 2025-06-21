@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Cập nhật hóa đơn</h3>
                        </div>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('receptionist/invoice/update', $invoice->invoice_id) }}" method="POST"
                            role="form" class="needs-validation" novalidate>
                            @csrf @method('PUT')
                            <div class="row g-3">
                                @if (isset($patient))
                                    <input type="text" name="patient_id" value="{{ $patient->userid }}" hidden>

                                    <!-- Row 1 -->
                                    <div class="col-md-4">
                                        <label for="fullname" class="form-label">Họ và tên</label>
                                        <input type="text" class="form-control shadow-sm" id="fullname"
                                            value="{{ $patient->fullname }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="fullname" class="form-label">Giới tính</label>
                                        <input type="text" class="form-control shadow-sm" id="fullname"
                                            value="@if($patient->gender == 0) Nam @elseif($patient->gender == 1) Nữ @else Khác @endif">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="fullname" class="form-label">Ngày sinh</label>
                                        <input type="date" class="form-control shadow-sm" id="fullname"
                                            value="{{ $patient->birthday }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="tel" class="form-control shadow-sm" id="phone"
                                            value="{{ $patient->phone }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control shadow-sm" id="email"
                                            value="{{ $patient->email }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control shadow-sm" id="address"
                                            value="{{ $patient->address }}">
                                    </div>
                                @endif

                                <div class="table">
                                    <div class="card-header">
                                        <div class="card-title">Dịch vụ sử dụng</div>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Dịch vụ</th>
                                                <th scope="col">Giá tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($medical_record_services as $medical_record_service)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $medical_record_service->service_name }}</td>
                                                    <td>{{ $medical_record_service->price }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-4">
                                    <label for="total_amount" class="form-label">Tổng tiền</label>
                                    <input type="number" class="form-control shadow-sm" id="total_amount" name="total_amount"
                                        value="{{ $invoice->total_amount }}" disabled>
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="other_fee" class="form-label">Chi phí khác</label>
                                    <input type="number" class="form-control shadow-sm" id="other_fee" name="other_fee"
                                    value="{{ $invoice->other_fee }}">
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="other_fee_detail" class="form-label">Chi tiết chi phí khác</label>
                                    <input type="text" class="form-control shadow-sm" id="other_fee_detail" name="other_fee_detail"
                                    value="{{ $invoice->other_fee_detail }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="discount" class="form-label">Giảm giá</label>
                                    <input type="number" class="form-control shadow-sm" id="discount" name="discount"
                                        value="{{ $invoice->discount }}">
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="final_amount" class="form-label">Tổng tiền phải trả</label>
                                    <input type="number" class="form-control shadow-sm" id="final_amount" name="final_amount"
                                        value="{{ $invoice->final_amount }}" disabled>
                                </div>

                                <div class="col-md-4">
                                    <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                                    <select name="payment_method" id="payment_method" class="form-control shadow-sm">
                                        <option value="Tiền mặt" {{ $invoice->payment_method == 'Tiền mặt' ? 'selected' : '' }}>Tiền mặt</option>
                                        <option value="Chuyển khoản" {{ $invoice->payment_method == 'Chuyển khoản' ? 'selected' : '' }}>Chuyển khoản</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <a href="{{ url()->previous() }}" class="btn btn-warning"><i></i>Quay lại</a>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateFinalAmount() {
            const total = parseFloat(document.getElementById('total_amount').value) || 0;
            const discount = parseFloat(document.getElementById('discount').value) || 0;
            const otherFee = parseFloat(document.getElementById('other_fee').value) || 0;

            const final = total - discount + otherFee;

            document.getElementById('final_amount').value = final.toFixed(2);
        }

        // Gắn sự kiện lắng nghe khi người dùng thay đổi input
        document.getElementById('discount').addEventListener('input', calculateFinalAmount);
        document.getElementById('other_fee').addEventListener('input', calculateFinalAmount);

        // Tính lại khi trang được load
        window.addEventListener('DOMContentLoaded', calculateFinalAmount);
    </script>
@endsection
