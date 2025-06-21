@extends('layouts.master')

@section('content')
    <div class="about container">
        <div class="row gy-4 gx-5">
            <h2 class="section-title">Nha khoa Vinh - Chăm sóc nụ cười của bạn</h1>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="video-about position-relative align-self-start">
                        <img src="{{ asset('assets/img/about/about.jpg') }}" class="img-fluid" alt="">
                        <a href="https://youtu.be/7ZQpTB5J2_w?si=vhcYtmx9l7p1Pw-2" class="glightbox pulsating-play-btn"></a>
                    </div>
                    <img src="{{ asset('assets/img/about/about-2.jpg') }}" class="mt-4 img-fluid" alt="">
                </div>

                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <h3>Thông tin chung</h3>
                    <p class="backgroud-primary">Nha khoa Vinh được thành lập bởi đội ngũ bác sĩ chuyên khoa Răng Hàm Mặt có
                        trình độ chuyên môn cao, giàu
                        kinh nghiệm thực tiễn và lòng yêu nghề sâu sắc tại thành phố Vinh. Với tâm huyết xây dựng một địa
                        chỉ
                        chăm sóc răng miệng uy tín và thân thiện, chúng tôi luôn nỗ lực cập nhật công nghệ tiên tiến nhất,
                        không
                        ngừng hoàn thiện chất lượng dịch vụ để mang đến cho khách hàng trải nghiệm nha khoa hiện đại, an
                        toàn,
                        cùng chi phí điều trị hợp lý và minh bạch. Nha khoa Vinh cam kết đặt sức khỏe răng miệng và sự hài
                        lòng
                        tuyệt đối của khách hàng lên hàng đầu trong mọi hoạt động, đồng hành cùng bạn trên hành trình xây
                        dựng
                        nụ cười khỏe đẹp và tự tin.</p>
                    <ul>
                        <li>
                            <i class="fa-solid fa-user-doctor"></i>
                            <div>
                                <h5>Đội ngũ chuyên gia uy tín</h5>
                                <p>Các bác sĩ tại Nha khoa Vinh đều tốt nghiệp từ các Trường Đại học Y Dược. Với nhiều năm
                                    kinh nghiệm và
                                    tham gia các khóa đào tạo chuyên sâu ở nước ngoài, đội ngũ bác sĩ của chúng tôi luôn cập
                                    nhật các kỹ thuật và công nghệ mới nhất trong lĩnh vực nha khoa.</p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-bed-pulse"></i>
                            <div>
                                <h5>Quy trình điều trị chuẩn Mỹ</h5>
                                <p>Chúng tôi áp dụng quy trình điều trị chuẩn của Hiệp hội Nha khoa Hoa Kỳ (ADA), đảm bảo
                                    mọi công đoạn đều được thực hiện một cách chuyên nghiệp và an toàn. Bệnh nhân sẽ được tư
                                    vấn chi tiết về từng bước trong quá trình điều trị, giúp hiểu rõ và an tâm với phương
                                    pháp được lựa chọn.
                                </p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-teeth-open"></i>
                            <div>
                                <h5>Vật liệu chính hãng và bảo hành dài hạn</h5>
                                <p>Nha khoa Kim Cương cam kết chỉ sử dụng các vật liệu nha khoa chính hãng, đảm bảo chất
                                    lượng và an toàn cho bệnh nhân. Chúng tôi tự tin bảo hành lâu dài cho mọi dịch vụ, mang
                                    lại sự yên tâm tuyệt đối cho khách hàng.
                                </p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-house-chimney-medical"></i>
                            <div>
                                <h5>Hệ thống vô trùng hiện đại</h5>
                                <p>Để ngăn chặn nguy cơ lây nhiễm chéo, chúng tôi trang bị hệ thống vô trùng đạt chuẩn Bộ Y
                                    tế, đảm bảo môi trường điều trị an toàn tuyệt đối.
                                </p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-heart-circle-xmark"></i>
                            <div>
                                <h5>Thân thiện, nhiệt tình, không đau</h5>
                                <p>Với phương châm “khách hàng là trên hết”, các bác sĩ tại Nha khoa Kim Cương luôn làm việc
                                    với tinh thần thân thiện, nhiệt tình và thao tác nhẹ nhàng, không gây đau đớn, mang lại
                                    trải nghiệm thoải mái nhất cho bệnh nhân
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
        </div>
    </div>



    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Một số hình ảnh về Nha khoa Vinh</h3>
        </div><!-- End Section Title -->

        <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-0">

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('assets/img/gallery/gallery-1.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('assets/img/gallery/gallery-1.jpg') }}" alt="" class="gallery-img">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('assets/img/gallery/gallery-2.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('assets/img/gallery/gallery-2.jpg') }}" alt="" class="gallery-img">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('assets/img/gallery/gallery-3.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('assets/img/gallery/gallery-3.jpg') }}" alt="" class="gallery-img">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('assets/img/gallery/gallery-4.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('assets/img/gallery/gallery-4.jpg') }}" alt="" class="gallery-img">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('assets/img/gallery/gallery-5.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('assets/img/gallery/gallery-5.jpg') }}" alt="" class="gallery-img">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('assets/img/gallery/gallery-6.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('assets/img/gallery/gallery-6.jpg') }}" alt="" class="gallery-img">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('assets/img/gallery/gallery-7.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('assets/img/gallery/gallery-7.jpg') }}" alt="" class="gallery-img">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('assets/img/gallery/gallery-8.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('assets/img/gallery/gallery-8.jpg') }}" alt="" class="gallery-img">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

            </div>

        </div>

        <style>
            .gallery-img {
                width: 100%;
                height: 250px; /* bạn có thể điều chỉnh chiều cao tùy ý */
                object-fit: cover;
                border-radius: 8px; /* tùy chọn: bo góc ảnh */
            }
        </style>


    </section><!-- /Gallery Section -->
@endsection
