<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:nhakhoavinh@gmail.com">nhakhoavinh@gmail.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+84 344 518 332</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('/') }}" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="{{ asset('') }}assets/img/logo.png" alt=""> -->
                <h1 class="sitename">Nha khoa Vinh</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    @foreach ($menus->where('level', 1)->sortBy('menu_order') as $menu)
                        @php $submenus = $menus->where('parent_id', $menu->menu_id)->sortBy('menu_order') @endphp
                        @if ($submenus->count() == 0)
                            <li><a href="{{ route($menu->route_name) }}"
                                    class="{{ request()->is($menu->route_name) ? 'active' : '' }}">{{ $menu->menu_name }}</a>
                            </li>
                        @else
                            <li class="dropdown"><a
                                    href="{{ route($menu->route_name) }}"><span>{{ $menu->menu_name }}</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    @foreach ($submenus as $submenu)
                                        <li><a href="{{ route($submenu->route_name) }}"
                                                class="{{ request()->is($submenu->route_name) ? 'active' : '' }}">{{ $submenu->menu_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            @guest
                <!-- Nếu chưa đăng nhập, hiển thị nút Đăng nhập -->
                <a class="cta-btn d-none d-sm-block" href="{{ route('login') }}">Đăng nhập</a>
            @else
                @include('layouts.notification')

                <!-- Nếu đã đăng nhập, hiển thị biểu tượng người dùng -->
                <li class="dropdown list-unstyled mx-3">
                    <style>
                        .avatar-img {
                            width: 3rem;
                            height: 3rem;
                            object-fit: cover;
                        }
                    </style>
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('storage/images/' . Auth::user()->avatar) }}" alt="..."
                            class="avatar-img rounded-circle"> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                        @if (Auth::user()->role_id == 1)
                            <a class="dropdown-item" href="{{ route('admin/index') }}">Quản trị</a>
                        @elseif(Auth::user()->role_id == 2)
                            <a class="dropdown-item" href="{{ route('doctor/index') }}">Quản trị</a>
                        @elseif(Auth::user()->role_id == 3)
                            <a class="dropdown-item" href="{{ route('receptionist/index') }}">Quản trị</a>
                        @else
                            <a class="dropdown-item" href="{{ route('patient/profile', Auth::user()->user_id) }}">Thông tin cá nhân</a>
                            <a class="dropdown-item" href="{{ route('patient/appointment', Auth::user()->user_id) }}">Lịch
                                khám</a>
                            <a class="dropdown-item"
                                href="{{ route('patient/medical-record', Auth::user()->user_id) }}">Bệnh án</a>
                            <a class="dropdown-item" href="{{ route('patient/change-password', Auth::user()->user_id) }}">Đổi mật khẩu</a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                Đăng xuất
                            </button>
                        </form>
                    </div>
                </li>
            @endguest
        </div>
    </div> <!-- End Header -->
</header>

