@extends('layouts.doctor')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Đơn thuốc</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bệnh nhân</th>
                                        <th>Chuẩn đoán</th>
                                        <th>Ngày kê đơn</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prescriptions as $prescription)
                                        <tr>
                                            <td>{{ $prescription->prescription_id }}</td>
                                            @php $medical_record = $medical_records->where('record_id', $prescription->record_id)->first(); @endphp
                                            <td> {{ $patients->where('patient_id', $medical_record->patient_id)->first()->fullname }}</td>
                                            <td>{{ $medical_record->diagnosis }}</td>
                                            <td>{{ \Carbon\Carbon::parse($prescription->created_at)->format('d/m/Y') }}</td>
                                            <td>
                                                <a class="btn btn-link btn-primary btn-lg"
                                                    href="{{ route('doctor/don-thuoc/don-thuoc-show', $prescription->record_id ?? '0') }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
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
