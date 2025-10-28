@extends('layouts.master')

@section('content')
    <style>
        .post-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .post-cover {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .related-post {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .related-post img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }

        .related-title {
            font-weight: 500;
            margin: 0;
            font-size: 15px;
        }

        .related-date {
            font-size: 13px;
            color: #666;
        }

        @media (max-width: 768px) {
            .post-layout {
                flex-direction: column;
            }
        }
    </style>

    <div class="container py-5">
        <div class="row g-4">
            <!-- Bài viết chính -->
            <div class="col-md-8">
                <div class="post-container">
                    <h1 class="mb-4">{{ $post->title }}</h1>

                    @if ($post->images)
                        <img src="{{ asset('storage/images/post/' . $post->images) }}" alt="Cover Image" class="post-cover">
                    @endif

                    <div class="post-content">
                        {!! $post->contents !!}
                    </div>
                </div>
            </div>

            <!-- Bài viết khác -->
            <div class="col-md-4">
                <div class="post-container">
                    <h5 class="mb-3">Bài viết khác</h5>
                    @forelse ($relatedPosts as $related)
                        <a href="{{ route('home/post-detail', $related->post_id) }}" class="text-decoration-none text-dark">
                            <div class="related-post">
                                @if ($related->images)
                                    <img src="{{ asset('storage/images/post/' . $related->images) }}" alt="Thumbnail">
                                @endif
                                <div>
                                    <p class="related-title">{{ $related->title }}</p>
                                    <p class="related-date">{{ $related->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p>Không có bài viết khác.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
