@extends('layouts.master')

@section('content')
    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Dịch vụ nha khoa Vinh</h2>
        </div><!-- End Section Title -->

        <!-- Services List -->
        <div class="container space-2" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                @foreach ($services as $service)
                    <article class="col-md-4 p-2 col-sm-4 col-6">
                        <div class="card shadow mb-1 br-0">
                            <a href="{{ route('home/post-detail', $service->post_id)}}">
                                <div class="justify-content-center d-flex">
                                    <img class="img-fluid" width="232" height="150"
                                        src="{{ asset('storage/images/services/' . $service->image)}}"
                                        alt="{{ $service->service_name}}">
                                </div>
                                <h4 class="text-body mb-0 text-center py-4">{{ $service->service_name}}</h4>
                            </a>
                        </div>
                    </article>
                    <!-- End Service Item -->
                @endforeach
            </div>
        </div>

    </section><!-- /Services Section -->
@endsection
