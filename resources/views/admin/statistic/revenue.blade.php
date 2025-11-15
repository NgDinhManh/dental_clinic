@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Doanh thu</div>
                        <form id="filterForm" class="mb-3">
                            <label for="year">Năm:</label>
                            <select id="year" name="year" class="form-select d-inline w-auto mx-2">
                                @for ($y = 2023; $y <= now()->year; $y++)
                                    <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>
                                        {{ $y }}</option>
                                @endfor
                            </select>

                            <label for="month">Tháng:</label>
                            <select id="month" name="month" class="form-select d-inline w-auto mx-2">
                                <option value="">-- Tất cả --</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>Tháng
                                        {{ $m }}</option>
                                @endfor
                            </select>

                            <button type="submit" class="btn btn-primary">Thống kê</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Hóa đơn mới</div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Tên bệnh nhân</th>
                                        <th scope="col" style="max-width:300px">Dịch vụ</th>
                                        <th scope="col" class="text-center">Giảm giá</th>
                                        <th scope="col" class="text-center">Phí khác</th>
                                        <th scope="col" class="text-center">Tiền phải trả</th>
                                        <th scope="col" class="text-center">Phương thức</th>
                                        <th scope="col" class="text-center">Thời gian</th>
                                        <th scope="col" class="text-center">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <th scope="row">
                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                {{ $invoice->medical_record->patient->fullname }}
                                            </th>
                                            <td class="text-truncate" style="max-width:300px;">
                                                @foreach ($invoice->medical_record->medical_record_services as $medical_record_service)
                                                    {{ $medical_record_service->service->service_name . ', ' }}
                                                @endforeach
                                            </td>
                                            <td class="text-center">{{ $invoice->discount }}</td>
                                            <td class="text-center">{{ $invoice->other_fee }}</td>
                                            <td class="text-center">{{ $invoice->final_amount }}</td>
                                            <td class="text-center">{{ $invoice->payment_method }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center">
                                                @if ($invoice->status == 'Đã thanh toán')
                                                    <span class="badge badge-success">Đã thanh toán</span>
                                                @elseif ($invoice->status == 'Chưa thanh toán')
                                                    <span class="badge badge-warning">Chưa thanh toán</span>
                                                @endif
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

    <script>
        const labels = {!! json_encode($labels) !!};
        const data = {!! json_encode($data) !!};
    </script>

    <style>
        .chart-container {
            position: relative;
            height: 400px;
            /* hoặc chiều cao bạn muốn */
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: data,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + new Intl.NumberFormat().format(context
                                    .parsed.y) + ' VND';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat().format(value) + ' đ';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
