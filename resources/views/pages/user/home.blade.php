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
                @if($canAccess)
                  <a href="{{ route('detail', $blog->id) }}" class="text-decoration-none">
                @else
                  <div class="text-decoration-none" style="cursor: pointer;" onclick="showUpgradeAlert('{{ $blog->title }}', '{{ $requiredLevel }}')">
                @endif 

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

                    <!-- Access Level Badge -->
                    @if($blog->access && $blog->access->member)
                      <div class="mb-2">
                        <span class="badge rounded-pill bg-warning text-dark">
                          <i class="bi bi-shield-lock-fill me-1"></i> {{ $blog->access->member->name }} Only 
                        </span>
                      </div>
                    @else 
                      <div class="mb-2">
                        <span class="badge rounded-pill bg-success">
                          <i class="bi bi-unlock-fill me-1"></i> Free Access
                        </span>
                      </div>
                    @endif 

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

                @if($canAccess)
                  </a>
                @else 
                  </div>
                @endif  
              </div>
            </div>
          @endforeach
        </div>

      @endif 
    </div>
  </section>

   <!-- Upgrade Modal -->
  <div class="modal fade" id="upgradeModal" tabindex="-1" aria-labelledby="upgradeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="upgradeModalLabel">
            <i class="bi bi-shield-lock-fill me-2"></i> Access Restricted
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="text-center mb-3">
            <i class="bi bi-lock-fill display-1 text-warning"></i>
          </div>
          <h5 class="text-center mb-3" id="modalBlogTitle">Blog Title</h5>
          <div class="alert alert-info">
            <i class="bi bi-info-circle-fill me-2"></i>
            This blog requires <strong id="requiredLevel">PREMIUM</strong> membership to access.
          </div>
          <p class="text-muted text-center">
            Your current membership level is <strong id="userLevel">{{ Auth::user()->access }}</strong>.
          </p>
          <p class="text-center">
            Upgrade your membership to unlock this and other premium content!
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="{{ route('edit_membership') }}" class="btn btn-warning">
            <i class="bi bi-arrow-up-circle me-2"></i> Upgrade Now
          </a>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('addon-script')
  <script>
    function showUpgradeAlert(blogTitle, requiredLevel) {
      // Update modal content
      document.getElementById('modalBlogTitle').innerHTML = '<i class="bi bi-file-text-fill me-2"></i> ' + blogTitle;
      document.getElementById('requiredLevel').innerText = requiredLevel || 'PREMIUM';

      // Show modal 
      var myModal = new bootstrap.Modal(document.getElementById('upgradeModal'));
      myModal.show();
    }
  </script>
@endpush 