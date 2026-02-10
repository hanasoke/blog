@extends('layouts.sign.template')

@section('content')
<div class="container py-5">
  <div class="row g-4 justify-content-center">

    <!-- REGISTER -->
    <div class="col-lg-7">
      <div class="card auth-card p-4">
        <h3 class="fw-bold mb-1">Sign up</h3>
        <p class="text-muted mb-4">Enter your details below to create your account</p>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label">Date of Birth</label>
              <input type="date" name="birthdate" class="form-control">
            </div>

            <!-- <div class="col-md-6">
              <label class="form-label">Phone Number</label>
              <input type="text" class="form-control" placeholder="+62 812 xxxx">
            </div> -->

            <!-- <div class="col-md-6">
              <label class="form-label">Photo</label>
              <input type="file" name="photo" class="form-control" placeholder="Input Your Photo">
            </div> -->
          </div>

          <div class="d-flex gap-2 mt-4">
            <a href="{{ url('login') }}" class="btn btn-light w-50">Cancel</a>
            <button type="submit" class="btn btn-primary w-50">Register</button>
          </div>

          <p class="text-center mt-3 mb-0">
            Already have an account?
            <a href="{{ url('login') }}" class="text-decoration-none fw-semibold">Login</a>
          </p>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection
