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
        @if (isset($patient))
            <div class="row">
                <!-- Header thông tin -->
                <div class="d-flex align-items-center card mb-4 p-0 col-md-6">
                    <div class="avatar avatar-xxl">
                        <img src="{{ asset('storage/images/' . $patient->avatar) }}" class="avatar-img rounded-circle me-3"
                            alt="avatar">
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
                <div class="card mb-4 p-0 col-md-6">
                    <div class="card-header bg-primary text-white">
                        Thông tin cơ bản
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2">Ngày sinh:
                                {{ \Carbon\Carbon::parse($patient->birthday)->format('d/m/Y') }}
                            </li>
                            <li class="mb-2">SĐT: {{ $patient->phone }}</li>
                            <li class="mb-2">Địa chỉ: {{ $patient->address }}
                            </li>
                            <li class="mb-2">CCCD: {{ $patient->cccd }}</li>
                            <li class="mb-2">BHYT: {{ $patient->bhyt }}</li>
                            <li class="mb-2">Nhóm máu:
                                {{ $patient->blood_type }}
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tiền sử bệnh -->
                <div class="card mb-4 p-0 col-md-6">
                    <div class="card-header bg-warning">
                        Tiền sử bệnh, nha khoa
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @if ($patient->medical_history)
                                <li><strong>Tiền sử bệnh: </strong>{{ $patient->medical_history }}</li>
                            @else
                                <li>Không có tiền sử bệnh</li>
                            @endif

                            @if ($patient->dental_history)
                                <li><strong>Tiền sử nha khoa: </strong>{{ $patient->dental_history }}</li>
                            @else
                                <li>Không có tiền sử nha khoa</li>
                            @endif
                        </ul>

                    </div>
                </div>

                <!-- Dị ứng -->
                <div class="card col-md-6 mb-4 p-0">
                    <div class="card-header bg-danger text-white">
                        Dị ứng
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @if ($patient->allergies)
                                {{ $patient->allergies }}
                            @else
                                <p>Không có dị ứng</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <!-- Cột kê đơn thuốc -->
        <form action="{{ route('doctor/don-thuoc/don-thuoc-update', $medical_record->record_id) }}" method="POST"
            class="card p-4 row" enctype="multipart/form-data">
            @csrf @method('PUT')
            <h4 class="card-title">Thông tin đơn thuốc</h4>

            <!-- Kê đơn thuốc -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <i class="fa fa-prescription-bottle-alt me-2"></i>Thông tin đơn thuốc
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="prescription-table">
                        <thead>
                            <tr>
                                <th>Tên thuốc</th>
                                <th>Liều dùng</th>
                                <th>Số lượng</th>
                                <th>Chỉ dẫn</th>
                            </tr>
                        </thead>
                        <tbody id="prescription-body">
                            @php $rowIndex = 0; @endphp
                            @foreach ($prescription_details as $detail)
                                <tr id="row-{{ $rowIndex }}">
                                    <td><input type="text" name="medicines[{{ $rowIndex }}][medicine_name]"
                                            class="form-control" value="{{ $detail->medicine_name }}" required></td>
                                    <td><input type="text" name="medicines[{{ $rowIndex }}][dosage]"
                                            class="form-control" value="{{ $detail->dosage }}" required></td>
                                    <td><input type="number" name="medicines[{{ $rowIndex }}][quantity]"
                                            class="form-control" value="{{ $detail->quantity }}" required></td>
                                    <td><input type="text" name="medicines[{{ $rowIndex }}][instruction]"
                                            class="form-control" value="{{ $detail->instruction }}" required></td>
                                </tr>
                                @php $rowIndex++; @endphp
                            @endforeach
                            <!-- Dòng mẫu sẽ được thêm bằng JS -->
                        </tbody>
                    </table>

                    <input type="hidden" name="record_id" value="{{ $medical_record->record_id }}">
                    <input type="hidden" name="doctor_id" value="{{ Auth::user()->userid }}">
                    <input type="text" name="notes" class="form-control mt-3" placeholder="Ghi chú thêm (nếu có)"
                        {{ $prescription->notes }}>
                </div>
            </div>
            <!-- Nút hành động -->
            <div class="my-4 text-start">
                <a href="{{ url()->previous() }}" class="btn btn-lg btn-warning me-2">
                    <i class="fa fa-arrow-left me-2"></i>Trở lại
                </a>
            </div>
        </form>
    </div>

@endsection
