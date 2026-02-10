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
              <input type="text" name="name" class="form-control is-invalid"> 
              <div class="invalid-feedback">
                Full Name Cannot be Null or Duplicate Name 
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control is-invalid">
              <div class="invalid-feedback">
                Email Cannot be Null or Duplicate Email  
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control is-invalid">
              <div class="invalid-feedback">
                Password Cannot be Null   
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control is-invalid">
              <div class="invalid-feedback">
                Password Cannot be Null   
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Date of Birth</label>
              <input type="date" name="birthdate" class="form-control is-invalid">
              <div class="invalid-feedback">
                  Date of Birth Cannot be Null   
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Phone Number</label>
              <input type="text" name="phone" class="form-control is-invalid" id="phoneNumber">
              <div class="invalid-feedback">
                  Phone Cannot be Null   
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Photo</label>
              <input type="file" name="photo" class="form-control is-invalid" placeholder="Input Your Photo">
              <div class="invalid-feedback">
                  Phone Cannot be Null   
              </div>
            </div>
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

@push('addon-script')
  <script>
    $(document).ready(function() {
      $('#phoneNumber').on('keypress', function(e) {
        // Hanya izinkan karakter angka (0-9)
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
        }
        return true;
      });
      
      $('#phoneNumber').on('paste', function(e) {
        e.preventDefault();
        var pastedData = e.originalEvent.clipboardData.getData('text');
        var numbersOnly = pastedData.replace(/\D/g, '');
        $(this).val(numbersOnly);
      });
      
      $('#phoneNumber').on('input', function() {
        $(this).val($(this).val().replace(/\D/g, ''));
      });
    });
  </script>
@endpush