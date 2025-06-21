@extends('layouts.doctor')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .patient-info {
            background: white;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .treatment-plan {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
        }
    </style>
    <div class="container-fluid">
        <form action="{{ route('doctor/lich-lam-viec/kham-benh-lich/store') }}" method="post">
            @csrf
            <div class="row">
                <!-- Cột thông tin bệnh nhân -->
                @if (isset($patient))
                    <div class="col-md-4 patient-info">
                        <!-- Header thông tin -->
                        <div class="d-flex align-items-center mb-4">
                            <div class="avatar avatar-xxl">
                                <img src="{{ asset('storage/images/' . $patient->avatar) }}"
                                    class="avatar-img rounded-circle me-3" alt="avatar">
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $patient->fullname }}</h4>
                                <p class="text-muted mb-0">ID: BN-{{ $patient->userid }}</p>
                                <p class="text-muted">
                                    {{ \Carbon\Carbon::parse($patient->birthday)->age . ' tuổi | ' }}
                                    @if ($patient->gender == '0')
                                        Nam
                                    @else
                                        Nữ
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Thông tin cơ bản -->
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                Thông tin cơ bản
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-calendar me-2"></i>Ngày sinh:
                                        {{ \Carbon\Carbon::parse($patient->birthday)->format('d/m/Y') }}</li>
                                    </li>
                                    <li class="mb-2"><i class="bi bi-phone me-2"></i>SĐT: {{ $patient->phone }}</li>
                                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Địa chỉ: {{ $patient->address }}
                                    </li>
                                    <li class="mb-2"><i class="bi bi-phone me-2"></i>SĐT: {{ $patient->cccd }}</li>
                                    <li class="mb-2"><i class="bi bi-phone me-2"></i>SĐT: {{ $patient->bhyt }}</li>
                                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Nhóm máu:
                                        {{ $patient->blood_type }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Tiền sử bệnh -->
                        <div class="card mb-3">
                            <div class="card-header bg-warning">
                                Tiền sử bệnh, nha khoa
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-1"><strong>Tiền sử bệnh: </strong>{{ $patient->medical_history }}</li>
                                    <li><strong>Tiền sử nha khoa: </strong>{{ $patient->dental_history }}</li>
                                </ul>

                            </div>
                        </div>

                        <!-- Dị ứng -->
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                Dị ứng
                            </div>
                            <div class="card-body">
                                {{ $patient->allergies }}
                            </div>
                        </div>
                    </div>
                @endif


                <!-- Cột nhập thông tin khám nha khoa -->
                <div class="col-md-8 medical-record">

                    <input type="text" name="patient_id" value="{{ $patient->userid }}" hidden>
                    <input type="text" name="doctor_id" value="{{ Auth::user()->userid }}" hidden>
                    <input type="text" name="appointment_id" value="{{ $appointment->appointment_id }}" hidden>

                    <!-- Triệu chứng -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="bi bi-clipboard2-pulse me-2"></i>Triệu chứng
                        </div>
                        <div class="card-body">
                            {{-- <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="pain">
                                <label class="form-check-label" for="pain">Đau nhức</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="bleeding">
                                <label class="form-check-label" for="bleeding">Chảy máu nướu</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="sensitive">
                                <label class="form-check-label" for="sensitive">Ê buốt</label>
                            </div>
                        </div> --}}
                            <textarea class="form-control" name="symptoms" rows="2" placeholder="Mô tả triệu chứng chi tiết..." required></textarea>
                        </div>
                    </div>

                    <!-- Chẩn đoán -->
                    <div class="card mb-4">
                        <div class="card-header bg-warning">
                            <i class="bi bi-clipboard2-check me-2"></i>Chẩn đoán
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                {{-- <div class="col-md-6">
                                <label>Loại chẩn đoán</label>
                                <select class="form-select">
                                    <option>Sâu răng</option>
                                    <option>Viêm nha chu</option>
                                    <option>Viêm tủy</option>
                                    <option>Răng khôn mọc lệch</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Răng liên quan</label>
                                <input type="text" class="form-control" placeholder="VD: 16, 25, 36">
                            </div> --}}
                                <div class="col-12">
                                    <textarea class="form-control" name="diagnosis" rows="2" placeholder="Ghi chú chẩn đoán..." required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chọn dịch vụ -->
                    <div class="card mb-4 service-selection">
                        <div class="card-header bg-success text-white">
                            <i class="fa fa-clipboard2-plus me-2"></i>Chọn dịch vụ
                        </div>
                        <div class="row mx-2">
                            @foreach ($services as $service)
                                <div class="form-check mb-2 col-6">
                                    <input class="form-check-input" type="checkbox" name="services[{{ $loop->index + 1 }}]"
                                        value="{{ $service->service_id }}" id="service{{ $loop->index + 1 }}">
                                    <label class="form-check-label" for="service{{ $loop->index + 1 }}">
                                        {{ $service->service_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Kế hoạch điều trị -->
                    <div class="card mb-4 treatment-plan">
                        <div class="card-body">
                            <h5 class="mb-3"><i class="bi bi-clipboard2-plus me-2"></i>Kế hoạch điều trị</h5>
                            {{-- <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Răng</th>
                                        <th>Thủ thuật</th>
                                        <th>Vật liệu</th>
                                        <th>Ghi chú</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control" value="36"></td>
                                        <td>
                                            <select class="form-select">
                                                <option>Trám răng</option>
                                                <option>Nhổ răng</option>
                                                <option>Bọc răng sứ</option>
                                                <option>Lấy tủy</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select">
                                                <option>Composite</option>
                                                <option>Amalgam</option>
                                                <option>GIC</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" placeholder="Ghi chú"></td>
                                        <td><button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-sm btn-success">
                            <i class="bi bi-plus-circle me-2"></i>Thêm thủ thuật
                        </button> --}}
                            <div class="col-12">
                                <textarea class="form-control" name="treatment_plan" rows="2" placeholder="Kế hoạch điều trị..." required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Ghi chú cho bệnh nhân -->
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <i class="bi bi-chat-dots me-2"></i>Hướng dẫn sau điều trị
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" name="notes" rows="3" placeholder="Nhập hướng dẫn chăm sóc sau điều trị..."></textarea>
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="my-4">
                        <a href="{{ url()->previous() }}" class="btn btn-lg btn-warning me-2">
                            <i class="fa fa-arrow-left me-2"></i>Trở lại
                        </a>
                        <button type="submit" class="btn btn-lg btn-primary me-2">
                            <i class="fa fa-save me-2"></i>Lưu hồ sơ
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Thêm script xử lý chọn răng
        document.querySelectorAll('.tooth-number').forEach(item => {
            item.addEventListener('click', function() {
                this.classList.toggle('selected');

                // Cập nhật input răng liên quan
                const selectedTeeth = Array.from(document.querySelectorAll('.tooth-number.selected'))
                    .map(t => t.textContent).join(', ');
                document.querySelector('input[placeholder="VD: 16, 25, 36"]').value = selectedTeeth;
            });
        });
    </script>
@endsection
