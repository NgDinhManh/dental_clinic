@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Hóa đơn</h3>
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
                                                            <a class="dropdown-item text-info" href="{{ route('admin/receptionist/invoice/show', $invoice->invoice_id) }}">
                                                                Xem
                                                            </a>
                                                        </li>
                                                        @if ($invoice->status != 'Chưa thanh toán')
                                                            <li>
                                                                <a class="dropdown-item text-success" href="{{ route('admin/receptionist/invoice/reopen', $invoice->invoice_id) }}"
                                                                onclick="return confirm('Bạn có chắc chắn muốn mở lại hóa đơn này?')">
                                                                    Mở lại
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item text-danger" href="{{ route('admin/receptionist/invoice/decline', $invoice->invoice_id) }}"
                                                                onclick="return confirm('Bạn có chắc chắn muốn từ chối hóa đơn này?')">
                                                                    Từ chối
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
