@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Dịch vụ</div>
                        <form id="filterForm" method="GET" action="{{ route('admin/statistic/service') }}">
                            <label for="year">Năm:</label>
                            <select id="year" name="year" class="form-select d-inline w-auto">
                                @for ($y = 2023; $y <= now()->year; $y++)
                                    <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>
                                        {{ $y }}</option>
                                @endfor
                            </select>

                            <label for="month">Tháng:</label>
                            <select id="month" name="month" class="form-select d-inline w-auto mx-2">
                                <option value="">-- Tất cả tháng --</option>
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
                            <canvas id="serviceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('serviceChart').getContext('2d');

        const serviceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Số lần sử dụng dịch vụ',
                    data: {!! json_encode($data) !!},
                    backgroundColor: '#1d7af3',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
@endsection
