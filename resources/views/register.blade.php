<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}" />
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/icon-dental.jpg') }}">

    <title>Đăng ký</title>
    <style>
        body {
            margin-top: 20px;
            background: #f6f9fc;
        }

        .account-block {
            padding: 0;
            background-image: url(https://bootdey.com/img/Content/bg1.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            position: relative;
        }

        .account-block .overlay {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .account-block .account-testimonial {
            text-align: center;
            color: #fff;
            position: absolute;
            margin: 0 auto;
            padding: 0 1.75rem;
            bottom: 3rem;
            left: 0;
            right: 0;
        }

        .text-theme {
            color: #1977CC !important;
        }

        .btn-theme {
            background-color: #1977CC;
            border-color: #1977CC;
            color: #fff;
        }

        .btn-theme:hover {
            background-color: #186db8;
            color: #fff;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div id="main-wrapper" class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="card border-0">
                        <div class="card-body p-0">
                            <div class="row no-gutters">
                                <div class="col">
                                    <div class="p-5">
                                        <div class="mb-3 row">
                                            <a href="{{ route('/') }}"
                                                class="text-theme col-3 d-flex align-items-center">Trang
                                                chủ</a>
                                            <h3 class="h4 font-weight-bold text-theme text-center col-6">ĐĂNG KÝ</h3>
                                        </div>

                                        <h6 class="h5 mb-3">Chào mừng bạn!</h6>

                                        <form action="" method="POST" role="form">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Tên</label>
                                                <input type="text" name="name" class="form-control"
                                                    id="name">
                                                @error('name')
                                                    <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="password">Mật khẩu</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password">
                                                @error('password')
                                                    <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="confirm_password">Nhập lại mật khẩu</label>
                                                <input type="password" name="confirm_password" class="form-control"
                                                    id="confirm_password">
                                                @error('confirm_password')
                                                    <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-3 mb-4">
                                                <label for="phone">Số điện thoại</label>
                                                <input type="tel" name="phone" class="form-control"
                                                    id="phone">
                                                @error('phone')
                                                    <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button type="submit" class="btn btn-theme">Đăng ký</button>
                                                <a href="{{ route('login') }}"
                                                    class="text-theme d-flex align-items-center">Đăng
                                                    nhập</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <!-- end row -->

                </div>
                <!-- end col -->
            </div>
            <!-- Row -->
        </div>
    </div>
</body>

</html>
