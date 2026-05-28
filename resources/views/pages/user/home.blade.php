@extends('layouts.user.template')

@section('content')
  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <h1 class="text-uppercase fw-semibold">Blog</span>
        </div>
      </div>
    </div>
  </section>

  <!-- BLOG LIST -->
  <section class="py-5">
    <div class="container">

      <!-- Alert Error -->
      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <strong>Access Denied!</strong> {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if($blogs->isEmpty())
        <div class="text-center py-5">
          <h4>Belum ada blog</h4>
          <p class="text-muted">Silahkan cek kembali nanti.</p>
        </div>
      @else 
        <div class="row g-4">
          @foreach($blogs as $blog)
            @php 
              $canAccess = false;
              $requiredLevel = null;
              $user = Auth::user();

              // Check if user can access this blog
              if($user->access == 'VIP') {
                $canAccess = true;
              } elseif(!$blog->access) {
                $canAccess = true;
              } elseif($blog->access && $blog->access->member) {
                $accessLevels = ['FREE' => 0, 'BASIC' => 1, 'PREMIUM' => 2, 'VIP' => 3];
                $userLevel = $accessLevels[$user->access] ?? 0;
                $requiredLevelNum = $accessLevels[$blog->access->member->name] ?? 0;
                $canAccess = $userLevel >= $requiredLevelNum;
                $requiredLevel = $blog->access->member->name;
              }
            @endphp

            <div class="col-md-6 col-lg-4">
              <div class="card blog-card h-100 border-0 shadow-sm">
                <a href="{{ route('detail', $blog->id) }}" class="text-decoration-none">
                  @if($blog->thumbnail)
                    <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="card-img-top" alt="{{ $blog->title }}">
                  @else 
                    <img src="{{ asset('user_assets/thumbnail/error_website.png') }}" alt="Error Website">
                  @endif 
                  <div class="card-body">
                    <!-- Author & Date -->
                    <small class="text-muted">{{ $blog->user->name ?? 'Unknown Author' }} · {{ $blog->created_at ? $blog->created_at->format('d M Y') : 'Date not set' }}</small>

                    <!-- Title -->
                    <h5 class="mt-2 fw-semibold text-dark">
                      {{ Str::limit($blog->title, 60) }}
                    </h5>

                    <!-- Description -->
                    <p class="text-muted">
                      {{ Str::limit(strip_tags($blog->description), 100) }}
                    </p>

                    <!-- Tags/Genres -->
                    <div class="d-flex gap-2 flex-wrap">
                      @if($blog->genre)
                        <span class="badge rounded-pill badge-tag">
                          {{ $blog->genre->name }}
                        </span>
                      @endif 

                      @if($blog->source)
                        <span class="badge rounded-pill badge-tag">
                          {{ $blog->source->name }}
                        </span>
                      @endif 
                    </div>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        </div>

      @endif 
    </div>
  </section>
@endsection