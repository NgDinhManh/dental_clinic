@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Đặt lịch khám</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('receptionist/appointment/create') }}" method="GET" class="card p-4">
                            <h4 class="card-title">Tìm kiếm bệnh nhân</h4>
                            <div class="form-group">
                                <div class="input-icon">
                                    <input type="tel" name="search_phone" class="form-control"
                                        placeholder="Nhập số điện thoại" value="{{ request('search') }}">
                                    <span class="input-icon-addon">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('receptionist/appointment/store') }}" method="post" role="form"
                            class="needs-validation" novalidate>
                            @csrf
                            <div class="row g-3">
                                @if (isset($patient))
                                    <input type="text" name="patient_id" value="{{ $patient->patient_id }}" hidden>

                                    <!-- Row 1 -->
                                    <div class="col-md-4">
                                        <label for="fullname" class="form-label fs-5">Họ và tên</label>
                                        <input type="text" class="form-control shadow-sm" id="fullname"
                                            value="{{ $patient->fullname }}" placeholder="Nguyễn Văn A">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="email" class="form-label fs-5">Email</label>
                                        <input type="email" class="form-control shadow-sm" id="email"
                                            value="{{ $patient->email }}" placeholder="Nhập email">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="form-label fs-5">Số điện thoại</label>
                                        <input type="tel" class="form-control shadow-sm" id="phone"
                                            value="{{ $patient->phone }}" placeholder="0987 654 321">
                                    </div>
                                @endif

                                <!-- Row 2 -->
                                <div class="col-md-4">
                                    <label for="appointment-date" class="form-label fs-5">Chọn ngày khám</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control shadow-sm datepicker"
                                            id="appointment-date" name="appointment_date" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label fs-5">Khung giờ khả dụng</label>
                                    <div id="slots-container" class="row">
                                        <div class="alert alert-info">Vui lòng chọn ngày để xem khung giờ</div>
                                    </div>
                                </div>

                                <!-- Row 3 -->
                                <div class="col-md-12">
                                    <label for="service" class="form-label fs-5">Dịch vụ</label>
                                    <div class="row border border-secondary-subtle mx-1 rounded shadow-sm p-3">
                                        @foreach ($services as $service)
                                            <div class="form-check mb-2 col-4">
                                                <input class="form-check-input" type="checkbox"
                                                    name="services[{{ $loop->index + 1 }}]"
                                                    value="{{ $service->service_id }}" id="service{{ $loop->index + 1 }}">
                                                <label class="form-check-label" for="service{{ $loop->index + 1 }}">
                                                    {{ $service->service_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="notes" class="form-label fs-5">Ghi chú/Ghi chú yêu cầu</label>
                                    <textarea class="form-control shadow-sm" name="notes" id="notes" rows="2"
                                        placeholder="Mô tả triệu chứng hoặc yêu cầu thêm..."></textarea>
                                </div>

                                <div class="col-md-12">
                                    <a href="{{ url()->previous() }}" class="btn btn-warning"><i></i>Quay lại</a>
                                    <button type="submit" class="btn btn-primary">Đặt lịch</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom CSS */
        .datepicker {
            position: relative;
            z-index: 1000;
        }

        #slots-container .btn-time {
            margin: 5px;
            min-width: 100px;
            transition: all 0.3s ease;
        }

        #slots-container .btn-time.selected {
            background: #0d6efd;
            color: white;
        }

        .form-label fs-5 {
            font-weight: 500;
            color: #2c3e50;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 12px 15px;
        }

        .selectgroup {
            display: inline-flex;
        }

        .selectgroup-item {
            flex-grow: 1;
            position: relative;
        }

        .selectgroup-input {
            opacity: 0;
            position: absolute;
            z-index: -1;
            top: 0;
            left: 0;
        }

        .selectgroup-input:checked+.selectgroup-button {
            border-color: #1572e8;
            z-index: 1;
            color: #1572e8;
            background: rgba(21, 114, 232, .15);
        }

        .selectgroup-item:not(:last-child) .selectgroup-button {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .selectgroup-button {
            display: block;
            border: 1px solid rgba(0, 40, 100, .12);
            text-align: center;
            padding: .375rem 1rem;
            position: relative;
            cursor: pointer;
            border-radius: 3px;
            color: #9aa0ac;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            font-size: 1rem;
            line-height: 1.5rem;
            min-width: 2.375rem;
        }
    </style>

    <script>
        const dateInput = document.getElementById('appointment-date');
        const slotsContainer = document.getElementById('slots-container');

        dateInput.addEventListener('change', () => {
            const date = dateInput.value;
            if (!date) return;

            const selectedDate = new Date(date);
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Reset giờ phút giây để so sánh ngày

            // Kiểm tra nếu chọn ngày trong quá khứ
            if (selectedDate < today) {
                slotsContainer.innerHTML =
                    '<p style="color:red;">Không thể đặt lịch cho ngày trong quá khứ. Vui lòng chọn ngày khác.</p>';
                return;
            }

            slotsContainer.innerHTML = '<p>Đang tải khung giờ...</p>'; // loading tạm thời

            fetch("{{ url('home/appointment/slots') }}?date=" + encodeURIComponent(date))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Mạng hoặc server lỗi.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.length === 0) {
                        slotsContainer.innerHTML = '<p>Không có khung giờ khả dụng.</p>';
                        return;
                    }

                    const slotsHtml = data.map(slot => `
                        <label class="selectgroup-item col-3" style="display:block;margin-bottom:10px;" required>
                            <input type="radio" name="appointment_time" value="${slot.time}" class="selectgroup-input"
                                ${slot.available <= 0 ? 'disabled' : ''}>
                            <span class="selectgroup-button">
                                ${slot.time} - ${slot.booked}/5 đã đặt ${slot.available <= 0 ? '(Hết chỗ)' : ''}
                            </span>
                        </label>
                    `).join('');

                    slotsContainer.innerHTML = slotsHtml;
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    slotsContainer.innerHTML = '<p>Lỗi tải khung giờ. Vui lòng thử lại.</p>';
                });
        });
    </script>
@endsection
