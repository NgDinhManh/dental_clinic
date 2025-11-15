@extends('layouts.doctor')

@section('content')
    <style>
        .treatment-plan {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
        }
    </style>

    <div class="page-inner">
        <!-- Cột thông tin bệnh nhân -->
        <div class="row">
            @if (isset($patient))
                <div class="card col-md-6 p-0">
                    <div class="card-body">
                        <div class="card">
                            <div class="d-flex align-items-center p-3">
                                <div class="avatar avatar-xxl me-3">
                                    <img src="{{ asset('storage/images/avatar/' . $patient->avatar) }}" class="avatar-img rounded-circle"
                                        alt="avatar">
                                </div>
                                <div>
                                    <h4 class="mb-0">{{ $patient->fullname }}</h4>
                                    <p class="text-muted mb-0">ID: BN-{{ $patient->patient_id }}</p>
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
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Thông tin cơ bản
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Ngày sinh:
                                    {{ \Carbon\Carbon::parse($patient->birthday)->format('d/m/Y') }}
                                </li>
                                <li class="list-group-item">SĐT: {{ $patient->phone }}</li>
                                <li class="list-group-item">Địa chỉ: {{ $patient->address }}
                                </li>
                                <li class="list-group-item">CCCD: {{ $patient->cccd }}</li>
                                <li class="list-group-item">BHYT: {{ $patient->bhyt }}</li>
                                <li class="list-group-item">Nhóm máu:
                                    {{ $patient->blood_type }}
                                </li>
                            </ul>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Tiền sử bệnh, nha khoa
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if ($patient->medical_history)
                                    <li class="list-group-item"><strong>Tiền sử bệnh:</strong>{{ $patient->medical_history }}</li>
                                @else
                                    <li class="list-group-item">Không có tiền sử bệnh</li>
                                @endif

                                @if ($patient->dental_history)
                                    <li class="list-group-item"><strong>Tiền sử nha khoa:</strong>{{ $patient->dental_history }}</li>
                                @else
                                    <li class="list-group-item">Không có tiền sử nha khoa</li>
                                @endif
                            </ul>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    Dị ứng
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($patient->allergies)
                                    {{ $patient->allergies }}
                                @else
                                    <p>Không có dị ứng</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Triệu chứng
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $medical_record->symptoms }}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Chuẩn đoán
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $medical_record->diagnosis }}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Dịch vụ
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach ($medical_record->medical_record_services as $medical_record_service)
                                        <li class="list-group-item">{{ $medical_record_service->service->service_name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Kế hoạch điều trị
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $medical_record->treatment_plan ?? '' }}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Hướng dẫn sau điều trị
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $medical_record->note }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Cột kê đơn thuốc -->
        <form action="{{ route('doctor/don-thuoc/don-thuoc-update', $medical_record->record_id) }}" method="POST"
            class="card" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="card-header">
                <div class="card-title">Thông tin đơn thuốc</div>
            </div>

            <!-- Kê đơn thuốc -->
            <div class="container">
                <div class="card-header bg-success text-white">
                    <i class="fa fa-prescription-bottle-alt me-2"></i>Kê đơn thuốc
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="prescription-table">
                        <thead>
                            <tr>
                                <th>Tên thuốc</th>
                                <th>Liều dùng</th>
                                <th>Số lượng</th>
                                <th>Chỉ dẫn</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="prescription-body">
                            @php $rowIndex = 0; @endphp
                            @foreach ($prescription_details as $detail)
                                <tr id="row-{{ $rowIndex }}">
                                    <td><input type="text" name="medicines[{{ $rowIndex }}][medicine_name]"
                                            class="form-control" value="{{ $detail->medicine_name }}" required></td>
                                    <td><input type="text" name="medicines[{{ $rowIndex }}][dosage]"
                                            class="form-control" value="{{ $detail->dosage }}"></td>
                                    <td><input type="number" name="medicines[{{ $rowIndex }}][quantity]"
                                            class="form-control" value="{{ $detail->quantity }}" required></td>
                                    <td><input type="text" name="medicines[{{ $rowIndex }}][instruction]"
                                            class="form-control" value="{{ $detail->instruction }}" required></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="removeMedicineRow({{ $rowIndex }})">
                                            Xóa
                                        </button>
                                    </td>
                                </tr>
                                @php $rowIndex++; @endphp
                            @endforeach
                            <!-- Dòng mẫu sẽ được thêm bằng JS -->
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-outline-success" onclick="addMedicineRow()">
                        <i class="fa fa-plus-circle me-1"></i>Thêm thuốc
                    </button>

                    <input type="hidden" name="record_id" value="{{ $medical_record->record_id }}">
                    <input type="hidden" name="doctor_id" value="{{ Auth::user()->user_id }}">
                    <input type="text" name="notes" class="form-control mt-3" placeholder="Ghi chú thêm (nếu có)"
                        {{ $prescription->notes }}>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="card-action p-3 text-center">
                <a href="{{ url()->previous() }}" class="btn btn-warning me-2">
                    <i class="fa fa-arrow-left me-2"></i>Trở lại
                </a>
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fa fa-save me-2"></i>Lưu đơn thuốc
                </button>
            </div>
        </form>
    </div>

    {{-- Thêm thuốc --}}
    <script>
        let rowIdx = {{ $rowIndex }};

        function addMedicineRow() {
            rowIdx++;
            const row = `
            <tr id="row-${rowIdx}">
                <td><input type="text" name="medicines[${rowIdx}][medicine_name]" class="form-control" required></td>
                <td><input type="text" name="medicines[${rowIdx}][dosage]" class="form-control"></td>
                <td><input type="number" name="medicines[${rowIdx}][quantity]" class="form-control" required></td>
                <td><input type="text" name="medicines[${rowIdx}][instruction]" class="form-control" required></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeMedicineRow(${rowIdx})">
                        Xóa
                    </button>
                </td>
            </tr>
        `;
            document.getElementById('prescription-body').insertAdjacentHTML('beforeend', row);
        }

        function removeMedicineRow(idx) {
            const row = document.getElementById('row-' + idx);
            if (row) row.remove();
        }
    </script>

@endsection
