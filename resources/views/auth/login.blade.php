@extends('layouts.user.home')

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

@section('content')
<div class="container">
    <div class="row g-4 justify-content-center">
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
@endsection
