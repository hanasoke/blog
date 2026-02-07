@extends('layouts.login.template')

@section('content')
<div class="container mt-5">
    <div class="row g-4 justify-content-center">
        <!-- LOGIN -->
        <div class="col-md-5">
            <div class="card auth-card p-4 h-100">
                <h3 class="fw-bold mb-1 text-center">Welcome back</h3>
                <p class="text-muted mb-4 text-center">Login to your account</p>

                <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="enter email...">
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="enter password...">
                </div>

                <div class="form-group form-check mb-2">
                  <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input" id="remember">
                  <label class="form-check-label" for="remember">
                      {{__('Remember Me') }}
                  </label>
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
@endsection
