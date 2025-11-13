<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Nha Khoa Vinh</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/icon-dental.jpg') }}" type="image/x-icon">

    <!-- our project just needs Font Awesome Solid + Brands -->
    <link href="{{ asset('admin_assets/fontawesome/css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/fontawesome/css/brands.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/fontawesome/css/solid.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/fontawesome/css/sharp-thin.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/fontawesome/css/duotone-thin.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/fontawesome/css/sharp-duotone-thin.css') }}" rel="stylesheet" />

    <!-- Fonts and icons -->
    <script src="{{ asset('admin_assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/main.css') }}" />

    {{-- Trình soạn thảo văn bản Froala --}}
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@4.0.10/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2" data-background-color="white">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="white">
                    <a href="{{ route('/') }}" class="logo">
                        {{-- <img src="{{ asset('admin_assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" /> --}}
                        <h3 class="m-0 text-black fw-bold">Nha khoa Vinh</h3>
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item submenu {{ request()->is('admin/statistic' . '*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Bảng điều khiển</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/statistic' . '*') ? 'show' : '' }}"
                                id="dashboard">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->is('admin/statistic') ? 'active' : '' }}">
                                        <a href="{{ route('admin/index') }}">
                                            <span class="sub-item">Bảng thống kê</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/statistic/service') ? 'active' : '' }}">
                                        <a href="{{ route('admin/statistic/service') }}">
                                            <span class="sub-item">Thống kê dịch vụ</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/statistic/revenue') ? 'active' : '' }}">
                                        <a href="{{ route('admin/statistic/revenue') }}">
                                            <span class="sub-item">Thống kê doanh thu</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Chức năng</h4>
                        </li>

                        @foreach ($menu_admins->where('level', 1)->sortBy('menu_order') as $menu)
                            @php $submenus = $menu_admins->where('parent_id', $menu->menu_id)->sortBy('menu_order'); @endphp
                            @if ($submenus->count() == 0)
                                <li class="nav-item">
                                    <a href="#">
                                        <i class="{{ $menu->icon }}"></i>
                                        <p>{{ $menu->menu_name }}</p>
                                    </a>
                                </li>
                            @else
                                <li
                                    class="nav-item submenu {{ request()->is($menu->route_name . '*') ? 'active' : '' }}">
                                    <a data-bs-toggle="collapse" href="#{{ $menu->menu_target }}">
                                        <i class="{{ $menu->icon }}"></i>
                                        <p>{{ $menu->menu_name }}</p>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse {{ request()->is($menu->route_name . '*') ? 'show' : '' }}"
                                        id="{{ $menu->menu_target }}">
                                        <ul class="nav nav-collapse">
                                            @foreach ($submenus as $submenu)
                                                <li class="{{ request()->is($submenu->route_name) ? 'active' : '' }}">
                                                    <a href="{{ route($submenu->route_name) }}">
                                                        <span class="sub-item">{{ $submenu->menu_name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        {{-- @include('layouts.admin_sidebar') --}}
        <!-- End Sidebar -->

        <div class="main-panel">
            <!-- Hiển thị thông báo -->
            @include('layouts.alerts')

            <!-- Navbar -->
            @include('layouts.admin_header')
            <!-- End Navbar -->

            <!-- Content -->
            <div class="container">
                @yield('content')
            </div>
            <!-- End Content -->

        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('admin_assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('admin_assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('admin_assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <!-- Chart JS -->

    <!-- jQuery Sparkline -->
    <script src="{{ asset('admin_assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('admin_assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('admin_assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('admin_assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('admin_assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('admin_assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('admin_assets/js/kaiadmin.min.js') }}"></script>

    <!-- Modal Xác Nhận Xóa -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa mục này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Xóa</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let deleteFormId = '';

            // Lắng nghe sự kiện khi click vào nút xóa
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    deleteFormId = this.getAttribute('data-form-id');
                });
            });

            // Khi nhấn nút "Xóa" trong modal
            document.getElementById('confirmDeleteButton').addEventListener('click', function() {
                if (deleteFormId) {
                    document.getElementById(deleteFormId).submit();
                }
            });
        });
    </script>

    {{-- Tải hình ảnh lên --}}
    @include('layouts.admin_image_upload')

    @livewireScripts


    {{-- script datatables --}}
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});

            $("#multi-filter-select").DataTable({
                pageLength: 5,
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $(
                                    '<select class="form-select"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column
                                        .search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append(
                                        '<option value="' + d + '">' + d + "</option>"
                                    );
                                });
                        });
                },
            });

            // Add Row
            $("#add-row").DataTable({
                pageLength: 5,
            });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $("#addRowButton").click(function() {
                $("#add-row")
                    .dataTable()
                    .fnAddData([
                        $("#addName").val(),
                        $("#addPosition").val(),
                        $("#addOffice").val(),
                        action,
                    ]);
                $("#addRowModal").modal("hide");
            });
        });
    </script>
</body>

</html>
