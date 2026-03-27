@extends('layouts.sign.template')

@section('content')
<div class="container mt-5">
    <div class="row g-4 justify-content-center">
        <!-- LOGIN -->
        <div class="col-md-8">
            <div class="card auth-card p-4 h-100">
                <h3 class="fw-bold mb-1 text-center">Welcome back</h3>
                <p class="text-muted mb-4 text-center">Login to your account</p>

                @if (session('resent'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Email verifikasi telah dikirim ulang</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                @if (session('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('error') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                @if (session('status'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert"">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif


                <form method="POST" action="{{ route('login') }}">
                  @csrf 
                  <div class="mb-3">
                      <label for="email" class="form-label">{{ __('E-mail Address') }}</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Input Your Email" autofocus>

                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror 
                  </div>

                  <div class="mb-2">
                      <label for="password" class="form-label">{{ _('Password') }}</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Input Your Password">
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror 
                  </div>

                  <div class="form-group form-check mb-2">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">
                        {{__('Remember Me') }}
                    </label>
                  </div>

                  <button type="submit" class="btn btn-primary w-100">
                    {{ __('Login')}}
                  </button>
                </form>
                <p class="text-center mt-2 mb-0">
                    @if(Route::has('password.request'))
                        {{ __('Forgot Your Password?') }}
                      <a href="{{ route('password.request') }}" class="text-decoration-none fw-semibold">
                        Click Here
                      </a>
                    @endif 
                </p>
                <p class="text-center mt-1 mb-0">
                    Don’t have an account?
                    <a href="{{ url('register') }}" class="text-decoration-none fw-semibold">Sign up for free</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
