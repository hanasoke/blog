<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Blog Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .hero {
      background: #3563f3;
      color: #fff;
      padding: 100px 0;
      position: relative;
      overflow: hidden;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 700;
    }

    .hero p {
      max-width: 420px;
      opacity: .9;
    }

    .subscribe-box {
      max-width: 480px;
    }

    .blog-card img {
      height: 220px;
      object-fit: cover;
    }

    .badge-tag {
      border: 1px solid #dee2e6;
      font-weight: 500;
      color: #495057;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Untitled UI</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto gap-3">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Solutions</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
        <li class="nav-item"><a class="btn btn-outline-light rounded-pill px-4" href="#">Get started</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <span class="text-uppercase small fw-semibold">Blog</span>
        <h1 class="mt-3">
          The Journal: Design Resources, Interviews, and Industry News
        </h1>

        <div class="subscribe-box mt-4 d-flex gap-2">
          <input type="email" class="form-control form-control-lg" placeholder="Enter your email">
          <button class="btn btn-light px-4 fw-semibold">Subscribe</button>
        </div>
      </div>

      <div class="col-lg-5 mt-4 mt-lg-0">
        <p>
          Subscribe to learn about new product features, the latest in technology, solutions, and updates.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- BLOG LIST -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">

      <!-- CARD 1 -->
      <div class="col-md-6 col-lg-4">
        <div class="card blog-card h-100 border-0 shadow-sm">
          <img src="https://picsum.photos/600/400?1" class="card-img-top" alt="">
          <div class="card-body">
            <small class="text-muted">Olivia Rhye · 20 Jan 2024</small>
            <h5 class="mt-2 fw-semibold">
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
        </div>
      </div>

      <!-- CARD 2 -->
      <div class="col-md-6 col-lg-4">
        <div class="card blog-card h-100 border-0 shadow-sm">
          <img src="https://picsum.photos/600/400?2" class="card-img-top" alt="">
          <div class="card-body">
            <small class="text-muted">Phoenix Baker · 19 Jan 2024</small>
            <h5 class="mt-2 fw-semibold">
              A Relentless Pursuit of Perfection in Product Design
            </h5>
            <p class="text-muted">
              I began to notice that there was a sharp contrast between well-made...
            </p>

            <div class="d-flex gap-2 flex-wrap">
              <span class="badge rounded-pill badge-tag">Product</span>
              <span class="badge rounded-pill badge-tag">Research</span>
              <span class="badge rounded-pill badge-tag">Frameworks</span>
            </div>
          </div>
        </div>
      </div>

      <!-- CARD 3 -->
      <div class="col-md-6 col-lg-4">
        <div class="card blog-card h-100 border-0 shadow-sm">
          <img src="https://picsum.photos/600/400?3" class="card-img-top" alt="">
          <div class="card-body">
            <small class="text-muted">Lana Steiner · 18 Jan 2024</small>
            <h5 class="mt-2 fw-semibold">
              How to Run a Successful Business With Your Partner
            </h5>
            <p class="text-muted">
              Starting a business with your spouse or significant other is exciting...
            </p>

            <div class="d-flex gap-2 flex-wrap">
              <span class="badge rounded-pill badge-tag">Design</span>
              <span class="badge rounded-pill badge-tag">Research</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
