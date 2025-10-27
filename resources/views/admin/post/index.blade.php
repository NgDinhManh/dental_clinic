@extends('layouts.admin')

@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Bài viết</h3>
                                <a class="btn btn-success btn-round ms-auto" href="{{ route('admin/post/create') }}">
                                    <i class="fa fa-plus"></i>
                                    Thêm
                                </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 30%">Tiêu đề</th>
                                        <th style="width: 30%">Tóm tắt</th>
                                        <th>Tác giả</th>
                                        <th>Ngày tạo</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><div class="text-truncate-2">{{ $post->title }}</div></td>
                                            <td><div class="text-truncate-2">{{ $post->abstract }}</div></td>
                                            <td>{{ $post->author }}</td>
                                            <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis"></i>
                                                    </button>

                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin/post/show', $post->post_id) }}"
                                                                class="dropdown-item text-info">Xem</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin/post/edit', $post->post_id) }}"
                                                                class="dropdown-item text-primary">Chỉnh sửa</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admin/post/destroy', $post->post_id) }}"
                                                                class="d-flex align-items-center delete-form" method="POST"
                                                                id="delete-form-{{ $post->post_id }}">
                                                                @csrf @method('delete')
                                                                <button type="button"
                                                                    class="dropdown-item text-danger delete-button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#confirmDeleteModal"
                                                                    data-form-id="delete-form-{{ $post->post_id }}">
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
