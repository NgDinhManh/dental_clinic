@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Hóa đơn</h3>
                            <a class="btn btn-primary ms-auto" href="{{ route('receptionist/invoice/reload') }}">
                                <i class="fa fa-rotate me-1"></i>
                                Cập nhật hóa đơn
                            </a>
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
                                        <th>Dịch vụ</th>
                                        <th>Số tiền trả</th>
                                        <th>Ngày khám</th>
                                        <th>Trạng thái</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->invoice_id }}</td>
                                            <td>{{ $invoice->fullname }}</td>
                                            <td class="text-truncate" style="max-width: 200px;">
                                                @foreach ($medical_record_services->where('record_id', $invoice->record_id) as $service)
                                                    {{ $service->service_name . ', ' }}
                                                @endforeach
                                            </td>
                                            <td>{{ $invoice->final_amount }}</td>
                                            <td>{{ \Carbon\Carbon::parse($invoice->checkup_date)->format('d/m/Y') }}</td>
                                            <td>
                                                @if ($invoice->status == 'Chưa thanh toán')
                                                    <span class="badge badge-warning">Chưa thanh toán</span>
                                                @elseif($invoice->status == 'Đã thanh toán')
                                                    <span class="badge badge-success">Đã thanh toán</span>
                                                @else
                                                    <span class="badge badge-danger">Đã hủy</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                <button class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item text-info" href="{{ route('receptionist/invoice/show', $invoice->invoice_id) }}">
                                                                Xem
                                                            </a>
                                                        </li>
                                                        @if ($invoice->status == 'Chưa thanh toán')
                                                            <li>
                                                                <a class="dropdown-item text-primary" href="{{ route('receptionist/invoice/edit', $invoice->invoice_id) }}">
                                                                    Chỉnh sửa
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('receptionist/invoice/pay', $invoice->invoice_id) }}" method="POST">
                                                                    @csrf @method('put')
                                                                    <button type="submit" class="dropdown-item text-success" onclick="return confirm('Bạn có chắc chắn muốn thanh toán hóa đơn này không?')">Thanh toán</button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('receptionist/invoice/cancel', $invoice->invoice_id) }}" method="POST">
                                                                    @csrf @method('put')
                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy hóa đơn này không?')">Hủy</button>
                                                                </form>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a class="dropdown-item text-primary" href="{{ route('receptionist/invoice/reopen', $invoice->invoice_id) }}">
                                                                    Yêu cầu mở lại
                                                                </a>
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
