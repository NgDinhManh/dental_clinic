@extends('layouts.receptionist')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('receptionist/appointment/update', $appointment->appointment_id) }}" method="POST" role="form"
                    class="needs-validation card" novalidate>
                    @csrf @method('PUT')
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Cập nhật lịch khám</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">
                            @if (isset($patient))
                                <input type="text" name="patient_id" value="{{ $patient->patient_id }}" hidden>

                                <!-- Row 1 -->
                                <div class="col-md-4">
                                    <label for="fullname" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="fullname"
                                        value="{{ $patient->fullname }}" placeholder="Nguyễn Văn A">
                                </div>

                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        value="{{ $patient->email }}" placeholder="Nhập email">
                                </div>
                                <div class="col-md-4">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="phone"
                                        value="{{ $patient->phone }}">
                                </div>
                            @endif

                            <!-- Row 2 -->
                            <div class="col-md-4">
                                <label for="appointment-date" class="form-label">Chọn ngày khám</label>
                                <div class="input-group">
                                    <input type="date" class="form-control datepicker"
                                        id="appointment-date" name="appointment_date"
                                        value="{{ $appointment->appointment_date }}" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Khung giờ khả dụng</label>
                                <div id="slots-container" class="row">
                                </div>
                            </div>

                            <!-- Row 3 -->
                            <div class="col-md-12">
                                <label for="service" class="form-label">Dịch vụ</label>
                                <div class="row border border-secondary-subtle mx-1 rounded p-3">
                                    @foreach ($services as $service)
                                        <div class="form-check mb-2 col-4">
                                            <input class="form-check-input" type="checkbox"
                                                name="services[{{ $loop->index + 1 }}]"
                                                value="{{ $service->service_id }}" id="service{{ $loop->index + 1 }}"
                                                {{ in_array($service->service_id, $appointment_services_service_id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="service{{ $loop->index + 1 }}">
                                                {{ $service->service_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="notes" class="form-label">Ghi chú/Ghi chú yêu cầu</label>
                                <textarea class="form-control" name="notes" id="notes" rows="2"
                                    placeholder="Mô tả triệu chứng hoặc yêu cầu thêm..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-action text-center p-3">
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Trở lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
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

        .form-label {
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
            display: inline-block;
            width: 100%;
            padding: 10px 15px;
            text-align: center;
            background-color: #f8f9fa;
            /* Màu nền mặc định */
            border: 1px solid #ced4da;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
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
                                ${slot.available <= 0 ? 'disabled' : ''}
                                ${slot.time === '{{ $appointment->appointment_time }}' && date === '{{ $appointment->appointment_date }}' ? 'checked' : ''}>
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
        // Gọi khi load lần đầu nếu có ngày hẹn cũ
        if (dateInput.value) {
            const event = new Event('change');
            dateInput.dispatchEvent(event);
        }
    </script>
@endsection
