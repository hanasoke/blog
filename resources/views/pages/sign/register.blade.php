@extends('layouts.sign.template')

@section('content')
<div class="container py-5">
  <div class="row g-4 justify-content-center">
    <div class="col-lg-7">
      <div class="card auth-card p-4">
        <h3 class="fw-bold mb-1">Sign up</h3>
        <p class="text-muted mb-4">Enter your details below to create your account</p>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
          @csrf
          
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="name">Full Name</label>
              <input type="text" name="name" id="name" class="form-control is-invalid" value="#">
                <div class="invalid-feedback">
                  Error 
                </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control is-invalid" value="#">
              <div class="invalid-feedback">
                Error 
              </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control is-invalid" value="#">
              <div class="invalid-feedback">
                Error 
              </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control is-invalid" value="#">
              <div class="invalid-feedback">
                  Error 
                </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="birthdate">Date of Birth</label>
              <input type="date" name="birthdate" id="birthdate" class="form-control is-invalid" value="#">
              <div class="invalid-feedback">
                  Error 
                </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="phone">Phone Number</label>
              <input type="text" name="phone" id="phone" class="form-control is-invalid" value="#">
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="photo">Photo</label>
              <input type="file" name="photo" id="photo" class="form-control is-invalid">
              <small class="text-muted">Max: 2MB (JPG, PNG, GIF)</small>
              <div class="invalid-feedback">
                Error 
              </div>
            </div>
          </div>
          
          <div class="form-check mt-3">
            <input class="form-check-input is-invalid" type="checkbox" name="terms" id="terms">
            <label class="form-check-label" for="terms">
              I agree to the <a href="#">Terms and Conditions</a>
            </label>
            <div class="invalid-feedback">
              Error 
            </div>
          </div>
          
          <div class="d-flex gap-2 mt-4">
            <a href="{{ route('login') }}" class="btn btn-light w-50">Cancel</a>
            <button type="submit" class="btn btn-primary w-50">Register</button>
          </div>
          
          <p class="text-center mt-3 mb-0">
            Already have an account?
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login</a>
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
  // Phone number validation
  $('#phone').on('keypress', function(e) {
    var charCode = (e.which) ? e.which : e.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  });
  
  $('#phone').on('paste', function(e) {
    e.preventDefault();
    var pastedData = e.originalEvent.clipboardData.getData('text');
    var numbersOnly = pastedData.replace(/\D/g, '');
    $(this).val(numbersOnly);
  });
  
  $('#phone').on('input', function() {
    $(this).val($(this).val().replace(/\D/g, ''));
  });
  
  // Birthdate validation (must be at least 13 years old)
  $('#birthdate').on('change', function() {
    var birthdate = new Date($(this).val());
    var today = new Date();
    var age = today.getFullYear() - birthdate.getFullYear();
    var m = today.getMonth() - birthdate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
      age--;
    }
    
    if (age < 13) {
      alert('You must be at least 13 years old to register.');
      $(this).val('');
    }
  });
});
</script>
@endpush