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
                        <h4 class="mb-0">Bệnh án của bạn</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @empty($medical_records->count())
                                <div class="bg-secondary bg-opacity-10 text-center col-10 mx-auto p-5 rounded-3">
                                    <strong>Không có bệnh án nào!</strong>
                                </div>
                            @endempty
                            @foreach ($medical_records as $record)
                                <div class="p-2">
                                    <div class="d-flex align-items-center row">
                                        <div class="col-1 text-center">
                                            <i class="fa-solid fa-file-medical"
                                                style="font-size: 30px; color: var(--accent-color);"></i>
                                        </div>
                                        <div class= "col-3">
                                            <h5 class="card-title mb-1">
                                                <strong>Bác sĩ:
                                                </strong>{{ $users->where('userid', $record->doctor_id)->first()->fullname }}
                                            </h5>
                                            <p class="mb-1">
                                                <strong>Ngày khám: </strong> {{ $record->created_at->format('d/m/Y') }} <br>
                                                {{-- <strong>Bác sĩ:</strong> {{ $record->doctor_name }} --}}
                                            </p>
                                        </div>
                                        <div class= "col-4">
                                            <p class="mb-1">
                                                <strong>Triệu chứng: </strong> {{ $record->symptoms }} <br>
                                                <strong>Chuẩn đoán: </strong> {{ $record->diagnosis }} <br>
                                            </p>
                                        </div>
                                        <div class="col-1">
                                            {{-- Trạng thái --}}
                                            <span
                                                class="badge 
                                        @if ($record->status == 'Đang điều trị') bg-warning text-dark
                                        @elseif($record->status == 'Hoàn tất') bg-success @endif
                                     fs-6">
                                                {{ $record->status }}
                                            </span>
                                        </div>

                                        {{-- Xem bệnh án nếu đã khám --}}
                                        <div class="col-3 d-flex justify-content-center">
                                            <a href="{{ route('patient/medical-record-detail', $record->record_id) }}"
                                                class="btn btn-outline-primary btn-sm me-3">
                                                Bệnh án
                                            </a>
                                            @isset($invoices->where('record_id', $record->record_id)->first()->invoice_id)
                                                <a href="{{ route('patient/invoice', $invoices->where('record_id', $record->record_id)->first()->invoice_id) }}"
                                                    class="btn btn-outline-primary btn-sm">
                                                    Hóa đơn
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        <!-- Blog Pagination Section -->
                        <div class="d-flex justify-content-center">
                            {{ $medical_records->links() }}
                        </div>
                        <!-- End Blog Pagination Section -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
