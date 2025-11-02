<div class="col-lg-3 mb-4">
    <div class="card shadow">
        <div class="card-body">
            <div class="text-center">
                <div class="mb-3">
                    <img src="{{ asset('storage/images/avatar/' . $user->avatar) }}" alt="Xem trước ảnh"
                        class="img-thumbnail shadow-sm rounded-circle"
                        style="width: 200px; height:200px; object-fit:cover;">
                    <h5 class="mt-3">{{ $user->fullname }}</h5>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
            <hr>
            <nav class="nav flex-column">
                <a class="nav-link active" href="{{ route('patient/account', $user->user_id) }}">
                    <i class="fa-solid fa-user me-2"></i> Thông tin tài khoản
                </a>
                <a class="nav-link active" href="{{ route('patient/profile', $user->user_id) }}">
                    <i class="fa-solid fa-address-book me-2"></i> Thông tin cá nhân
                </a>
                <a class="nav-link" href="{{ route('patient/appointment', $user->user_id) }}">
                    <i class="fa-solid fa-calendar me-2"></i> Lịch khám
                </a>
                <a class="nav-link" href="{{ route('patient/medical-record', $user->user_id) }}">
                    <i class="fa-solid fa-file-medical me-2"></i> Bệnh án
                </a>
                <a class="nav-link" href="{{ route('patient/change-password', Auth::user()->user_id) }}">
                    <i class="fa-solid fa-key me-2"></i> Đổi mật khẩu
                </a>
                <form action="{{ route('logout') }}" method="POST" class="nav-link">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất
                    </button>
                </form>
            </nav>
        </div>
    </div>
</div>
