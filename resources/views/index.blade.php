@extends('layouts.master')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

        <img src="{{ asset('assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

        <div class="container position-relative">

            <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
                <h2>CHÀO MỪNG ĐẾN VỚI</h2>
                <h2>NHA KHOA VINH</h2>
                <p>Chúng tôi là ngũ bác sĩ chuyên khoa Răng Hàm Mặt giàu kinh nghiệm và tâm huyết tại TP.Vinh.</p>
            </div><!-- End Welcome -->

            <div class="content row gy-4">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
                        <h3>Chuyên nghiệp</h3>
                        <p>
                            Đội ngũ bác sĩ chuyên khoa răng hàm mặt, với nhiều năm kinh nghiệm và tay nghề vững vàng, cam
                            kết mang đến cho bạn nụ cười hoàn hảo và sự an tâm tuyệt đối.
                        </p>
                        <div class="text-center">
                            <a href="{{ route('home/about') }}" class="more-btn"><span>Đọc thêm</span> <i
                                    class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div><!-- End Why Box -->

                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="d-flex flex-column justify-content-center">
                        <div class="row gy-4">

                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                                    <i class="bi bi-clipboard-data"></i>
                                    <h4>Hiện đại</h4>
                                    <p>Phòng khám trang bị hệ thống máy móc, công nghệ điều trị tiên tiến hàng đầu, đảm bảo
                                        quy trình chăm sóc răng miệng nhanh chóng, an toàn và chính xác
                                    </p>
                                </div>
                            </div><!-- End Icon Box -->

                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                                    <i class="bi bi-gem"></i>
                                    <h4>Tận tâm</h4>
                                    <p>Chúng tôi luôn dành thời gian lắng nghe, tư vấn tận tình và thiết kế phương án điều
                                        trị cá nhân hóa, phù hợp nhất với từng nhu cầu riêng biệt của khách hàng
                                    </p>
                                </div>
                            </div><!-- End Icon Box -->

                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                                    <i class="bi bi-inboxes"></i>
                                    <h4>Tin cậy</h4>
                                    <p>Với hàng ngàn ca điều trị thành công và sự tin tưởng từ cộng đồng, phòng khám tự hào
                                        là điểm đến lý tưởng để bạn an tâm chăm sóc sức khỏe răng miệng lâu dài</p>
                                </div>
                            </div><!-- End Icon Box -->

                        </div>
                    </div>
                </div>
            </div><!-- End  Content-->

        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container">

            <div class="row gy-4 gx-5">

                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('assets/img/about/about.jpg') }}" class="img-fluid" alt="">
                    <a href="https://youtu.be/7ZQpTB5J2_w?si=vhcYtmx9l7p1Pw-2" class="glightbox pulsating-play-btn"></a>
                </div>

                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <h3>Giới Thiệu</h3>
                    <p>
                        Nha khoa Vinh được thành lập bởi đội ngũ bác sĩ chuyên khoa Răng Hàm Mặt giàu kinh nghiệm và
                        tâm huyết tại TP.Vinh. Với mục tiêu mang đến cho khách hàng trải nghiệm nha khoa hiện đại, chất
                        lượng và chi phí hợp lý, Nha khoa Vinh luôn cam kết đặt sức khỏe và sự hài lòng của khách
                        hàng lên hàng đầu.
                    </p>
                    <ul>
                        <li>
                            <i class="fa-solid fa-user-doctor"></i>
                            <div>
                                <h5>Đội ngũ chuyên gia uy tín</h5>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-bed-pulse"></i>
                            <div>
                                <h5>Quy trình điều trị chuẩn Mỹ</h5>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-teeth-open"></i>
                            <div>
                                <h5>Vật liệu chính hãng và bảo hành dài hạn</h5>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-house-chimney-medical"></i>
                            <div>
                                <h5>Hệ thống vô trùng hiện đại</h5>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-heart-circle-xmark"></i>
                            <div>
                                <h5>Thân thiện, nhiệt tình, không đau</h5>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

        <style>
            .about .content ul li {
                display: flex;
                align-items: center;
                margin-top: 20px;
            }

            .about .content ul li h5 {
                margin: 0;
            }
        </style>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="fa-solid fa-user-doctor"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Bác sĩ</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="fa-regular fa-hospital"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Bệnh nhân đã phục vụ</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="fas fa-flask"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="8" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Năm hoạt động</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                    <i class="fas fa-award"></i>
                    <div class="stats-item">
                        <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Thành tựu</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section -->

    <!-- Event Section -->
    <section class="tintuc section">
        <div class="container">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tin tức & Sự kiện</h2>
            </div><!-- End Section Title -->

            <div class="row pt-3 mb-3 p-3" data-aos="fade-up" data-aos-delay="100">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    @if($featuredPostEvent)
                    <article class="col-md-12 col-sm-12 col-lg-12 transition-3d-hover col-sm-12">
                        <a class="" href="{{ route('home/post-detail', $featuredPostEvent) }}"
                            title="{{ $featuredPostEvent->title }}">
                            <div class="col-sm-12 col-md-12 col-lg-12 p-0">
                                <img class="rounded-3 img-fluid lazy-load" width="2254" height="1428"
                                    src="{{ asset('storage/images/' . $featuredPostEvent->images) }}"
                                    alt="{{ $featuredPostEvent->title }}">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 p-0">
                                <div class="py-2">
                                    <div class="h5 color-yellow-default text-justify text-truncate-2">
                                        {{ $featuredPostEvent->title }}</div>
                                    <p class="card-text hide-mobile"><small
                                            class="text-muted">{{ $featuredPostEvent->topic . ' - ' . $featuredPostEvent->created_at }}</small>
                                    </p>
                                    <div class="short-description card-text-dark hide-mobile text-truncate-3">
                                        {{ $featuredPostEvent->abstract }}</div>
                                </div>
                            </div>
                        </a>
                    </article>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6">
                    @foreach ($otherPostEvents as $otherPostEvent)
                        <article class="mb-2 transition-3d-hover col-12">
                            <a class="row p-0" title="Nha Khoa Kim tuyển dụng bác sĩ nha khoa định hướng Chỉnh nha"
                                href="{{ route('home/post-detail', $otherPostEvent) }}">
                                <div class="col-5 col-sm-5 col-md-4 col-lg-4 px-1">
                                    <img class="rounded-3 img-fluid lazy-load" width="555" height="312"
                                        src="{{ asset('storage/images/' . $otherPostEvent->images) }}" alt="">
                                </div>
                                <div class="col-7 col-sm-7 col-md-8 col-lg-8 p-0">
                                    <div class="pl-2 pt-2 pr-0">
                                        <h6 class="text-truncate-2">{{ $otherPostEvent->title }}</h6>
                                        <p class="card-text hide-mobile"><small
                                                class="text-muted">{{ $otherPostEvent->created_at }}</small></p>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section> <!-- /Event Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Dịch vụ nha khoa</h2>
        </div><!-- End Section Title -->

        <!-- Services List -->
        <div class="container space-2" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                @foreach ($services as $service)
                    <article class="col-md-4 p-2 col-sm-4 col-6">
                        <div class="card shadow mb-1 br-0 transition-3d-hover">
                            <a class="transition-3d-hover" title="{{ $service->service_name }}"
                                href="{{ route('home/post-detail', $service->post) }}">
                                <div class="justify-content-center d-flex">
                                    <img class="img-fluid" width="232" height="150"
                                        src="{{ asset('storage/images/service/' . $service->image) }}"
                                        alt="{{ $service->service_name }}">
                                </div>
                                <h4 class="text-body mb-0 text-center py-4">{{ $service->service_name }}</h4>
                            </a>
                        </div>
                    </article>
                    <!-- End Service Item -->
                @endforeach
            </div>
        </div>

    </section><!-- /Services Section -->

    <section id="dental-knowlegde">
        <div class="container section-title" data-aos="fade-up">
            <h2>Kiến thức răng miệng</h2>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                @foreach ($post_knowlegdes as $post_knowlegde)
                    <article class="col-md-4 col-sm-4 col-lg-4 transition-3d-hover col-6">
                        <div class="card border-0">
                            <a title="{{ $post_knowlegde->title }}"
                                href="{{ route('home/post-detail', $post_knowlegde) }}">
                                <img class="card-img img-fluid lazy-load" width="350" height="197"
                                    style="max-height:360px"
                                    src="{{ asset('storage/images/' . $post_knowlegde->images) }}"
                                    alt="{{ $post_knowlegde->title }}">
                                <h6 class="h6 py-2 card-text-dark">{{ $post_knowlegde->title }}</h6>
                            </a>
                        </div>
                    </article>
                    <!-- End Post Item -->
                @endforeach
            </div>
        </div>

    </section>

    <!-- Doctors Section -->
    <section id="doctors" class="doctors section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Đội ngũ Bác sĩ nhiều kinh nghiệm</h2>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">
                @foreach ($doctors as $doctor)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="team-member d-flex align-items-start">
                            <div class="pic"><img src="{{ asset('storage/images/avatar/' . $doctor->user->avatar) }}"
                                    class="img-fluid avatar-doctor" alt=""></div>
                            <style>
                                .doctors .team-member .pic {
                                    height: 150px;
                                }

                                .avatar-doctor {
                                    width: 150px;
                                    height: 150px;
                                    border-radius: 50%;
                                    object-fit: cover;
                                }
                            </style>
                            <div class="member-info">
                                <h4>{{ $doctor->fullname }}</h4>
                                <span>{{ $doctor->specialization }}</span>
                                <p>{{ $doctor->education }}</p>
                                <p>{{ $doctor->experience_years }} năm kinh nghiệm</p>
                            </div>
                        </div>
                    </div><!-- End Team Member -->
                @endforeach
            </div>
        </div>
    </section><!-- /Doctors Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Câu hỏi thường gặp</h2>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                    <div class="faq-container">
                        @foreach ($faqs as $faq)
                            <!-- Faq item-->
                            <div class="faq-item">
                                <h3>{{ $faq->question }}</h3>
                                <div class="faq-content">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->
                        @endforeach
                    </div>
                </div><!-- End Faq Column-->
            </div>
        </div>
    </section><!-- /Faq Section -->

@endsection
