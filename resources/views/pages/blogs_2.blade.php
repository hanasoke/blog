<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Blog Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f5f7fb;
    }

    .main-wrapper {
      background: #fff;
      border-radius: 24px;
      margin: 24px;
      padding-bottom: 40px;
    }

    .hero {
      padding: 80px 20px;
      text-align: center;
    }

    .hero h1 {
      font-weight: 700;
    }

    .search-box {
      max-width: 520px;
      margin: 30px auto 0;
    }

    .blog-card {
      position: relative;
      border-radius: 18px;
      overflow: hidden;
      color: #fff;
      height: 360px;
    }

    .blog-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .blog-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(0,0,0,.75), rgba(0,0,0,.1));
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: end;
    }

    .badge-category {
      background: rgba(255,255,255,.85);
      color: #000;
      font-size: 12px;
    }

    .sidebar img {
      width: 56px;
      height: 56px;
      object-fit: cover;
      border-radius: 12px;
    }
  </style>
</head>
<body>

<div class="main-wrapper">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-4 py-3">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">enjoy</a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-4 gap-3">
        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Service</a></li>
        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
      </ul>

      <div class="ms-auto d-flex gap-2">
        <button class="btn btn-light">Sign in</button>
        <button class="btn btn-primary">Register</button>
      </div>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <span class="badge rounded-pill bg-light text-dark mb-3">Blog</span>
  <h1>Discover our latest news</h1>
  <p class="text-muted mt-3">
    Discover the achievements that set us apart. From groundbreaking projects
    to industry accolades, we take pride in our accomplishments.
  </p>

  <div class="search-box d-flex gap-2">
    <input type="text" class="form-control" placeholder="Input Placeholder">
    <button class="btn btn-primary px-4">Find Now</button>
  </div>
</section>

<!-- CONTENT -->
<div class="container">
  <div class="row g-4">

    <!-- LEFT CONTENT -->
    <div class="col-lg-8">
      <h4 class="fw-bold mb-3">Whiteboards are remarkable.</h4>

      <div class="row g-4">
        <!-- CARD -->
        <div class="col-md-6">
          <div class="blog-card">
            <img src="https://picsum.photos/600/800?1">
            <div class="blog-overlay">
              <span class="badge badge-category rounded-pill mb-2">Health & Nutrition</span>
              <h5 class="fw-semibold">
                Wanderlust Unleashed: Top Hidden Gems You Must Visit This Year
              </h5>
              <p class="small">
                Discover unique, off-the-radar destinations around the world.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="blog-card">
            <img src="https://picsum.photos/600/800?2">
            <div class="blog-overlay">
              <span class="badge badge-category rounded-pill mb-2">Sustainability</span>
              <h5 class="fw-semibold">
                Travel Bucket List: 25 Destinations for Every Adventurer
              </h5>
              <p class="small">
                Explore a curated list of must-visit places for every traveler.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="blog-card">
            <img src="https://picsum.photos/600/800?3">
            <div class="blog-overlay">
              <span class="badge badge-category rounded-pill mb-2">Cultural Insights</span>
              <h5 class="fw-semibold">
                How to Travel Like a Local: Insider Tips for Authentic Experiences
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- SIDEBAR -->
    <div class="col-lg-4 sidebar">

      <h5 class="fw-bold">Featured</h5>
      <hr>

      <div class="d-flex gap-3 mb-3">
        <img src="https://picsum.photos/100?4">
        <div>
          <small class="text-muted">August 7, 2017</small>
          <p class="mb-0 fw-semibold">Top Hidden Gems: Must-Visit Spots This Year</p>
        </div>
      </div>

      <div class="d-flex gap-3 mb-4">
        <img src="https://picsum.photos/100?5">
        <div>
          <small class="text-muted">March 23, 2013</small>
          <p class="mb-0 fw-semibold">Bucket List: 25 Adventures for Every Traveler</p>
        </div>
      </div>

      <h5 class="fw-bold mt-4">Latest</h5>
      <hr>

      <div class="d-flex gap-3">
        <img src="https://picsum.photos/100?6">
        <div>
          <small class="text-muted">October 24, 2024</small>
          <p class="mb-0 fw-semibold">The Ordinary: Travel That Changes You</p>
        </div>
      </div>

    </div>

  </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
