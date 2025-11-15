@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Bảng thống kê</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Người dùng quan tâm</p>
                                    <h4 class="card-title">{{ $total_user }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-hospital-user"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Bệnh nhân</p>
                                    <h4 class="card-title">{{ $total_patient }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-user-doctor"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Bác sĩ</p>
                                    <h4 class="card-title">{{ $total_doctor }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="far fa-file-medical"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Ca điều trị</p>
                                    <h4 class="card-title">{{ $total_medical_record }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Người dùng mới</div>

                        </div>
                        <div class="card-list py-4">
                            @foreach ($new_users as $user)
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="{{ asset('storage/images/avatar/' . ($user->avatar ?? 'defaul-avatar.jpg')) }}" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">{{ $user->name }}</div>
                                        <div class="status">Người dùng mới</div>
                                    </div>

                                    <div class="date">
                                        @php \Carbon\Carbon::setLocale('vi');@endphp
                                        {{ $user->created_at->diffForHumans() }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Ca điều trị mới</div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Tên bệnh nhân</th>
                                        <th scope="col" class="text-center">Thời gian</th>
                                        <th scope="col" class="text-center">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($new_medical_records as $medical_record)
                                        <tr>
                                            <th scope="row">
                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                {{ $medical_record->patient->fullname }}
                                            </th>
                                            <td class="text-center">{{ $medical_record->created_at->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center">
                                                @if ($medical_record->status == 'Đang điều trị')
                                                    <span class="badge badge-warning">Đang điều trị</span>
                                                @elseif ($medical_record->status == 'Hoàn tất')
                                                    <span class="badge badge-success">Hoàn tất</span>
                                                @else
                                                    <span class="badge badge-danger">Đã hủy</span>
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

@endsection
