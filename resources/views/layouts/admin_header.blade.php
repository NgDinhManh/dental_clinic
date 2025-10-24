<div class="main-header">

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                {{-- Thông báo --}}
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification bg-danger">{{ $notifications->where('is_read', 0)->count() }}</span>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown" style="width: 400px;">
                        <li>
                            <div class="dropdown-title">
                                Bạn có {{ $notifications->where('is_read', 0)->count() }} thông báo mới
                            </div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    @foreach ($notifications as $notification)
                                        <a data-id="{{ $notification->notification_id }}"
                                            onclick="showNotificationDetail({{ $notification->notification_id }})"
                                            class="d-flex align-items-center justify-content-between p-2 border-bottom">
                                            <div class="d-flex align-items-center w-100">
                                                <div class="notif-icon notif-primary">
                                                    <i class="fa fa-bell"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block text-truncate" style="max-width: 260px;">{{ $notification->title }}</span>
                                                    <span class="time"
                                                        title="{{ $notification->created_at->format('d/m/Y H:i') }}">{{ $notification->created_at->locale('vi')->diffForHumans() }}</span>
                                                </div>
                                                <div class="notif-icon text-danger ms-auto">
                                                    <form action="{{ route('notification/markAsDeleted', $notification->notification_id) }}" method="POST">
                                                        @csrf @method('PUT')
                                                        <button class="btn btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            @if ($notification->is_read == 0)
                                                <div class="ms-2">
                                                    <i class="fa-solid fa-circle-exclamation text-danger"></i>
                                                </div>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li>
                            <button class="see-all btn cursor-pointer" id="showNotificationsBtn"  >Xem toàn bộ thông báo
                                <i class="fa fa-angle-right ms-auto"></i>
                            </button>
                        </li>
                    </ul>
                </li>
                {{-- End Thông báo --}}

                {{-- Hiển thị toàn bộ thông báo --}}
                <div id="notificationsPanel" class="position-fixed top-0 end-0 bg-white shadow-lg p-3 text-truncate"
                    style="width: 30%; height: 100vh; z-index: 1050; overflow-y: auto; display: none;">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Thông báo</h5>
                        <button id="closeNotificationsBtn" class="btn btn-sm btn-outline-secondary">Đóng</button>
                    </div>

                    <div id="notificationsList">
                        @foreach ($notifications as $notification)
                            <div class="notification-item border-bottom py-2 px-1 d-flex justify-content-between align-items-center"
                                data-id="{{ $notification->notification_id }}"
                                onclick="showNotificationDetail({{ $notification->notification_id }})">
                                <div class="d-flex align-items-center w-100">
                                    <div class="notif-icon notif-primary me-2">
                                        <i class="fa fa-bell"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-truncate" style="max-width: 260px;">{{ $notification->title ?? 'Thông báo' }}</div>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="notif-icon text-danger ms-auto">
                                        <form action="{{ route('notification/markAsDeleted', $notification->notification_id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <button class="btn btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @if (!$notification->is_read)
                                    <i class="fa-solid fa-circle-exclamation text-danger mt-1"></i>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- End hiển thị toàn bộ thông báo --}}


                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ asset('storage/images/avatar/' . Auth::user()->avatar) }}" alt="..."
                                class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="fw-bold">{{ Auth::user()->name }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ asset('storage/images/avatar/' . Auth::user()->avatar) }}" alt="image profile"
                                            class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                @if (Auth::user()->role_id == 1)
                                @elseif(Auth::user()->role_id == 2)
                                    <a class="dropdown-item"
                                        href="{{ route('doctor/profile', Auth::user()->user_id) }}">Hồ sơ</a>
                                    <a class="dropdown-item"
                                        href="{{ route('doctor/change-password', Auth::user()->user_id) }}">Đổi mật khẩu</a>
                                @elseif(Auth::user()->role_id == 3)
                                    <a class="dropdown-item"
                                        href="{{ route('receptionist/profile', Auth::user()->user_id) }}">Hồ sơ</a>
                                    <a class="dropdown-item"
                                        href="{{ route('receptionist/change-password', Auth::user()->user_id) }}">Đổi mật khẩu</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">Đăng xuất</button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

<!-- Overlay mờ nền -->
<div id="notificationOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"
     style="z-index:1999; display: none;"></div>

<!-- Hộp thông báo chi tiết -->
<div id="notificationDetail" class="p-4 border rounded shadow-lg bg-white col-10 col-md-6 col-lg-4"
     style="z-index:2000; display: none; transition: all 0.3s ease; position: fixed; top: 10%; left: 50%; transform: translateX(-50%);">

    <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-bell fa-lg text-primary me-2"></i>
            <h5 id="notificationDetailTitle" class="mb-0 fw-bold">Chi tiết thông báo</h5>
        </div>
    </div>

    <p id="notificationDetailContent" class="text-secondary mb-2"></p>

    <div class="text-end">
        <small id="notificationDetailTime" class="text-muted">
            <i class="fa-regular fa-clock me-1"></i>
        </small>
    </div>
</div>


<script>
    document.getElementById('showNotificationsBtn').addEventListener('click', function () {
        document.getElementById('notificationsPanel').style.display = 'block';
    });

    document.getElementById('closeNotificationsBtn').addEventListener('click', function () {
        document.getElementById('notificationsPanel').style.display = 'none';
    });

    // Hàm hiển thị chi tiết thông báo
    function showNotificationDetail(id) {
        fetch("{{ url('/notification') }}" + "/" + id) // route Laravel trả về JSON
            .then(response => response.json())
            .then(data => {
                document.getElementById('notificationDetail').style.display = 'block';
                document.getElementById('notificationDetailTitle').innerText = data.title || 'Thông báo';
                document.getElementById('notificationDetailContent').innerText = data.content || '(Không có nội dung)';
                document.getElementById('notificationDetailTime').innerText = data.created_at;

                // Hiển thị box & overlay
                document.getElementById('notificationDetail').style.display = 'block';
                document.getElementById('notificationOverlay').style.display = 'block';
            });
    }

    document.addEventListener('click', function(event) {
        const detailBox = document.getElementById('notificationDetail');
        const overlay = document.getElementById('notificationOverlay');

        // Nếu box đang hiển thị và click nằm ngoài box
        if (detailBox.style.display === 'block' && !detailBox.contains(event.target)) {
            detailBox.style.display = 'none';
            overlay.style.display = 'none';
        }
    });

</script>

