@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            {{-- Sidebar --}}
            @include('layouts.patient_sidebar')

            {{-- Content --}}
            <div class="col-lg-9">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="mb-0">Lịch khám của bạn</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @empty($appointments->count())
                                <div class="bg-secondary bg-opacity-10 text-center mx-auto p-5 rounded-3">
                                    <strong>Không có lịch khám nào!</strong>
                                </div>
                            @endempty
                            @foreach ($appointments as $appointment)
                                <div class="mx-0 p-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <i class="fa-solid fa-calendar-days mx-2"
                                                style="font-size: 30px; color: var(--accent-color);"></i>
                                        </div>
                                        <div class="mx-3">
                                            <h5 class="card-title mb-1">
                                                {{ $user->fullname }}
                                            </h5>
                                            <p class="mb-1">
                                                <strong>Ngày khám:</strong>
                                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}
                                                <br>
                                                <strong>Giờ:</strong> {{ $appointment->appointment_time }} <br>
                                                {{-- <strong>Bác sĩ:</strong> {{ $appointment->doctor_name }} --}}
                                            </p>
                                        </div>
                                        <div class="mx-3">
                                            <p class="mb-1">
                                                <strong>Dịch vụ:</strong>
                                                @php $service_ids = $appointment_services->where('appointment_id', $appointment->appointment_id)->pluck('service_id');  @endphp
                                                @foreach ($services->whereIn('service_id', $service_ids) as $service)
                                                    {{ $service->service_name }} <br>
                                                @endforeach
                                            </p>
                                        </div>
                                        <div class="mx-3">
                                            {{-- Trạng thái --}}
                                            <div>
                                                <span
                                                    class="badge 
                                    @if ($appointment->status == 'Chờ khám') bg-warning text-dark
                                    @elseif($appointment->status == 'Đã khám') bg-success
                                    @elseif($appointment->status == 'Đã hủy') bg-danger
                                    @elseif($appointment->status == 'Quá hẹn') bg-secondary @endif
                                 fs-6">
                                                    {{ $appointment->status }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Xóa hẹn nếu không muốn khám nữa --}}
                                        @if ($appointment->status == 'Chờ khám')
                                            <div class="ms-auto me-3">
                                                <div class="">
                                                    <a href="{{ route('patient/appointment-destroy', $appointment->appointment_id) }}"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa lịch khám này không?')">
                                                        <i class="bi bi-trash"></i> Xóa hẹn
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        <!-- Blog Pagination Section -->
                        <div class="d-flex justify-content-center">
                            {{ $appointments->links() }}
                        </div>
                        <!-- End Blog Pagination Section -->
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
