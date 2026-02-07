@extends('layouts.sign.template')

@section('content')
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
            <a href="{{ url('login') }}" class="text-decoration-none fw-semibold">Login</a>
          </p>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection
