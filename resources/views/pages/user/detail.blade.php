@extends('layouts.user.template')

@section('content')
<!-- Blog Content -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <!-- Blog Header -->
                <div class="mb-4">
                    <div class="blog-meta d-flex align-items-center mb-2">
                        <i class="bi bi-calendar3"></i> &nbsp; 
                        <span>{{ $blog->created_at ? $blog->created_at->format('F d, Y') : 'Date not set' }}</span>
                        <span class="mx-3">•</span>
                        <i class="bi bi-clock"></i> &nbsp;
                        <span>{{ round(strlen(strip_tags($blog->description)) / 200) }} min read</span>
                        <span class="mx-3">•</span>
                        <i class="bi bi-eye"></i> &nbsp;
                        <span>{{ $blog->views ?? 0 }} views</span>
                    </div>
                    <h1 class="display-4 fw-bold mb-4">{{ $blog->title }}</h1>
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        @if($blog->user && $blog->user->photo)
                            <img src="{{ asset('storage/' . $blog->user->photo) }}" class="rounded-circle" width="50" height="50" alt="Author">
                        @else 
                            <img src="{{ url('user_assets/icons/user.png') }}" class="rounded-circle" width="50" height="50" alt="Author">
                        @endif 
                        <div>
                            <h6 class="fw-bold mb-0">{{ $blog->user->name ?? 'Unknown Author' }}</h6>
                            <small class="text-muted">
                                @if($blog->user) 
                                    {{ $blog->user->roles ?? 'User' }}
                                @else 
                                    Author
                                @endif 
                            </small>
                        </div>
                        <div class="ms-auto">
                            <a href="#" class="btn btn-outline-primary btn-sm me-2" onclick="shareArticle()">
                                <i class="bi bi-share"></i> Share
                            </a>
                            <button class="btn btn-outline-secondary btn-sm" onclick="bookmarkArticle()">
                                <i class="bi bi-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Thumbnail Image -->
                @if($blog->thumbnail)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="img-fluid rounded-3 w-100" alt="{{ $blog->title }}">
                    </div>
                @endif 

                <!-- Article Content -->
                <div class="article-content">
                    {{ $blog->description }}
                </div>

                <!-- Additional Images -->
                @if($blog->image_2 || $blog->image_3)
                <div class="row g-4 my-4">
                    @if($blog->image_2) 
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $blog->image_2) }}" class="img-fluid rounded-3 w-100" alt="Additional image 1">
                        </div>
                    @endif 
                    @if($blog->image_3) 
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $blog->image_3) }}" class="img-fluid rounded-3 w-100" alt="Additional image 2">
                        </div>
                    @endif 
                </div>
                @endif 

                <!-- Social Share & Tags -->
                <div class="social-share mt-5">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-2">Genre & Source:</h6>
                            <div class="d-flex gap-2 flex-wrap">
                                @if($blog->genre)
                                    <span class="badge bg-primary">
                                        <i class="bi bi-tag"></i> {{ $blog->genre->name }}
                                    </span>
                                @endif 
                                @if($blog->source)
                                    <span class="badge bg-primary">
                                        <i class="bi bi-bookmark"></i> {{ $blog->source->name }}
                                    </span>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-2">Share this article:</h6>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary btn-sm px-3 py-2" onclick="shareToFacebook()">
                                    <i class="bi bi-facebook me-1"></i>Facebook
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm px-3 py-2" onclick="shareToTwitter()">
                                    <i class="bi bi-twitter me-1"></i>Twitter
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm px-3 py-2" onclick="shareToLinkedin()">
                                    <i class="bi bi-linkedin me-1"></i>LinkedIn
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Author Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center text-md-start mb-4 mb-md-0">
                @if($blog->user && $blog->user->photo)
                    <img src="{{ asset('storage/' . $blog->user->photo) }}" class="rounded-circle shadow-lg" width="120" height="120" alt="{{ $blog->user->username }}">
                @else 
                    <img src="{{ url('user_assets/icons/user.png') }}" class="rounded-circle" width="120" height="120" alt="Author">
                @endif 
            </div>
            <div class="col-md-9">
                <h4 class="fw-bold mb-2">
                    {{ $blog->user->name ?? 'Unknown Author' }}
                </h4>
                <p class="text-muted mb-2">
                    @if($blog->user && $blog->user->email)
                        {{ $blog->user->email }}
                    @else 
                        Author 
                    @endif 
                </p>
                <p>
                    @if($blog->user && $blog->user->birthdate)
                        Member Since {{ $blog->user->birthdate->format('Y') }}
                    @else 
                        Content Creator 
                    @endif 
                </p>
                <a href="{{ route('home') }}?author={{ $blog->user_id ?? '' }}" class="btn btn-primary">View all posts</a>
            </div>
        </div>
    </div>
</section>

<!-- Related Posts -->
@php 
    $relatedPosts = App\Blog::where('id', '!=', $blog->id)
        ->when($blog->genre_id, function($query) use ($blog) {
            return $query->where('genre_id', $blog->genre_id);
        })
        ->with(['genre', 'user'])
        ->take(3)
        ->get();
@endphp 

@if($relatedPosts->count() > 0)
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-5 text-center">Related Posts</h2>
        <div class="row g-4">
            @foreach($relatedPosts as $related)
                <div class="col-md-6 col-lg-4">
                    <article class="related-post h-100 shadow-lg">
                        <img src="{{ asset('img_detail_blogs/gallery/raja_ampat.jpg') }}" class="w-100" style="height: 200px; object-fit: cover;" alt="Post">
                        <div class="p-4">
                            <div class="blog-meta mb-2">
                                <i class="bi bi-calendar3"></i> {{ $related->created_at ? $related->created_at->format('M d, Y') : 'Date not set' }}
                            </div>
                            <h5 class="fw-bold mb-3">{{ Str::limit($related->title, 60) }}</h5>
                            <p class="text-muted mb-3">{{ Str::limit($related->description, 100) }}</p>
                            <a href="{{ route('detail', $related->id) }}" class="text-decoration-none">Read more <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif 

@endsection 