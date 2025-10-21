@extends('layouts.master')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">

        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Bài viết</h1>
                </div>
            </div>
        </div>
    </div><!-- End Page Title -->

    <form action="{{ route('home/post') }}" method="GET" role="search" class="d-flex w-50 mx-auto my-4">
        <input type="search" name="search_post" class="form-control me-2" placeholder="Tìm kiếm bài viết..." aria-label="Search"
            value="{{ request('search') }}">
        <button class="btn btn-outline-primary" type="submit" style="width: 120px;">Tìm kiếm</button>
    </form>

    <style>
        .blog-posts .post-img {
            object-fit: cover;
            height: 200px;
        }
    </style>

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">

        <div class="container">
            <div class="row gy-4">
                @foreach ($posts as $post)
                    <div class="col-lg-3">
                        <article>

                            <div class="post-img">
                                <img src="{{ asset('storage/images/' . $post->images) }}" alt="" class="img-fluid">
                            </div>

                            <p class="post-category">{{ $post->topic }}</p>

                            <h4 class="title text-truncate-2">
                                <a href="{{ route('home/post-detail', $post->post_id) }}">{{ $post->title }}</a>
                            </h4>

                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/img/avatar_default.jpg') }} " alt=""
                                    class="img-fluid post-author-img flex-shrink-0">
                                <div class="post-meta">
                                    <p class="post-author">{{ $post->author }}</p>
                                    <p class="post-date">
                                        <time datetime="2022-01-01">{{ $post->created_at->format('d/m/Y') }}</time>
                                    </p>
                                </div>
                            </div>

                        </article>
                    </div><!-- End post list item -->
                @endforeach
            </div>
        </div>
    </section>


    <!-- Blog Pagination Section -->
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
    <!-- End Blog Pagination Section -->
@endsection()
