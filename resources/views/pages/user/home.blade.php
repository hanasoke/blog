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
      @if($blogs->isEmpty())
        <div class="text-center py-5">
          <h4>Belum ada blog</h4>
          <p class="text-muted">Silahkan cek kembali nanti.</p>
        </div>

      @else 
        <div class="row g-4">

          <!-- CARD 1 -->
          <div class="col-md-6 col-lg-4">
            <div class="card blog-card h-100 border-0 shadow-sm">
              <a href="{{ route('detail') }}" class="text-decoration-none">
                <img src="https://picsum.photos/600/400?1" class="card-img-top" alt="">
                <div class="card-body">
                  <small class="text-muted">Olivia Rhye · 20 Jan 2024</small>
                  <h5 class="mt-2 fw-semibold text-dark">
                    Conversations with Our Favorite London Studio, Makr & Co.
                  </h5>
                  <p class="text-muted">
                    We sat down with London’s fast-growing brand and product design studio...
                  </p>

                  <div class="d-flex gap-2 flex-wrap">
                    <span class="badge rounded-pill badge-tag">Design</span>
                    <span class="badge rounded-pill badge-tag">Research</span>
                    <span class="badge rounded-pill badge-tag">Interviews</span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          
        </div>

      @endif 
    </div>
  </section>
@endsection