@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Tin nhắn</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Họ và tên</th>
                                        <th>Tiêu đề</th>
                                        <th>Phản hồi</th>
                                        <th>Ngày gửi</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->subject }}</td>
                                            <td class="text-truncate" style="max-width:200px">
                                                @if (empty($message->reply))
                                                    <span class="badge badge-warning fs-6 px-3">Chưa trả lời</span>
                                                @else
                                                    {{ $message->reply }}
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y H:m') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis"></i>
                                                    </button>

                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item text-info"
                                                                href="{{ route('admin/message/show', $message->message_id) }}">Xem</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-primary"
                                                            href="{{ route('admin/message/reply', $message->message_id) }}">Trả lời</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admin/message/destroy', $message->message_id) }}"
                                                                class="d-flex align-items-center delete-form" method="POST"
                                                                id="delete-form-{{ $message->message_id }}">
                                                                @csrf @method('delete')
                                                                <button type="button"
                                                                    class="dropdown-item text-danger delete-button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#confirmDeleteModal"
                                                                    data-form-id="delete-form-{{ $message->message_id }}">
                                                                    Xóa
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
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
