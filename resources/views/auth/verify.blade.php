@extends('layouts.sign.template')

@section('content')
<div class="container mt-5">
    <div class="row g-4 justify-content-center">
        <!-- LOGIN -->
        <div class="col-md-5">
            <div class="card auth-card p-4 h-100">
                <h3 class="fw-bold mb-1 text-center">Check Your Email Now Before Login</h3>
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('register') }}" class="btn btn-primary w-50">Register</a>
                    <a href="{{ route('login') }}" class="btn btn-light w-50">Login</a>
                </div>
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection