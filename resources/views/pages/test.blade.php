<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login & Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Icon -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f4f6fb, #eef2ff);
      min-height: 100vh;
    }
    .auth-card {
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,.08);
    }
    .btn-primary {
      background-color: #4f46e5;
      border: none;
    }
    .btn-primary:hover {
      background-color: #4338ca;
    }
    .form-control {
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row g-4 justify-content-center">

    <!-- REGISTER -->
    <div class="col-lg-7">
      <div class="card auth-card p-4">
        <h3 class="fw-bold mb-1">Sign up</h3>
        <p class="text-muted mb-4">Enter your details below to create your account</p>

        <form>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" placeholder="enter...">
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="example@gmail.com">
            </div>

            <div class="col-md-6">
              <label class="form-label">Date of Birth</label>
              <input type="date" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone Number</label>
              <input type="text" class="form-control" placeholder="+62 812 xxxx">
            </div>

            <div class="col-md-6">
              <label class="form-label">Nationality</label>
              <select class="form-select">
                <option>Indonesia</option>
                <option>Brazil</option>
                <option>USA</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">ID Type</label>
              <select class="form-select">
                <option selected disabled>Select</option>
                <option>KTP</option>
                <option>Passport</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" placeholder="enter...">
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirm Password</label>
              <input type="password" class="form-control" placeholder="enter...">
            </div>
          </div>

          <div class="d-flex gap-2 mt-4">
            <button type="reset" class="btn btn-light w-50">Cancel</button>
            <button type="submit" class="btn btn-primary w-50">Confirm</button>
          </div>

          <p class="text-center mt-3 mb-0">
            Already have an account?
            <a href="#" class="text-decoration-none fw-semibold">Login</a>
          </p>
        </form>
      </div>
    </div>

    <!-- LOGIN -->
    <div class="col-lg-5">
      <div class="card auth-card p-4 h-100">
        <h3 class="fw-bold mb-1">Welcome back</h3>
        <p class="text-muted mb-4">Login to your account</p>

        <button class="btn btn-light w-100 mb-3 d-flex align-items-center justify-content-center gap-2">
          <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="18">
          Continue with Google
        </button>

        <form>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="enter email...">
          </div>

          <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" placeholder="enter password...">
          </div>

          <button type="submit" class="btn btn-primary w-100">Login</button>

          <p class="text-center mt-3 mb-0">
            Don’t have an account?
            <a href="#" class="text-decoration-none fw-semibold">Sign up for free</a>
          </p>
        </form>
      </div>
    </div>

  </div>
</div>

</body>
</html>
