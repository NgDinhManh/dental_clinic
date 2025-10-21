@extends('layouts.master')

@section('content')
    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Liên hệ</h2>
        <p>Nếu bạn có bất kỳ câu hỏi hoặc yêu cầu, vui lòng liên hệ với chúng tôi qua địa chỉ email hoặc số điện thoại dưới đây.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Địa chỉ</h3>
                <p>Số 12, Trương Văn Lĩnh, Hà Huy Tập, TP Vinh, Nghệ An</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Điện thoại</h3>
                <p>+84 344 518 332</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email</h3>
                <p>nhakhoavinh@gmail.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

            <div class="col-lg-6 map-wrapper mb-5 p-0" data-aos="fade-up" data-aos-delay="200">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d917.6738625675167!2d105.6813217324758!3d18.711212222748866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3139cde2c01aeea3%3A0x27a247390eebf2e!2zMTIgVHLGsMahbmcgVsSDbiBMxKluaCwgSMOgIEh1eSBU4bqtcCwgVmluaCwgTmdo4buHIEFuLCBWaeG7h3QgTmFt!5e1!3m2!1svi!2s!4v1748786968810!5m2!1svi!2s"
                    width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!-- End Google Maps -->

            <style>
                .map-wrapper {
                    width: 50%;
                    margin: 0 auto; /* Căn giữa */
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
                    border-radius: 12px; /* Bo góc mềm mại */
                    overflow: hidden; /* Đảm bảo bo góc không bị cắt */
                }
            </style>

        </div>

        <div class="col-lg-8 mx-auto">
            <form action="{{ route('home/contact/send') }}" method="post" data-aos="fade-up" data-aos-delay="200">
                @csrf
              <div class="row gy-4">

                <input type="text" name="userid" value="{{ Auth::user()->userid ?? '' }}" hidden>

                <div class="col-md-4">
                  <input type="text" name="name" class="form-control" placeholder="Họ và tên" value="{{ Auth::user()->fullname ?? '' }}" required="">
                </div>

                <div class="col-md-4">
                  <input type="tel" name="phone" class="form-control" placeholder="Số điện thoại" value="{{ Auth::user()->phone ?? '' }}" required="">
                </div>

                <div class="col-md-4">
                  <input type="email" class="form-control" name="email" placeholder="Email" value="{{ Auth::user()->email ?? '' }}" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Tiêu đề" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="content" rows="6" placeholder="Nội dung" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary btn-lg px-5">Gửi</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

      </div>

    </section><!-- /Contact Section -->
@endsection
