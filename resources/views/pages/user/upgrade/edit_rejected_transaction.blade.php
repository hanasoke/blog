@extends('layouts.user.template')

@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="text-uppercase fw-semibold">Edit Rejected Transaction</h1>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif 

        @if($rejectMessage)
            <div class="alert alert-danger mb-4">
                <h5>
                    <i class="bi bi-envelope-exclamation-fill"></i> Admin Message: 
                </h5>
                <p style="white-space: pre-line;">{{ $rejectMessage->message }}</p>
                <small class="text-muted">Received: {{ $rejectMessage->created_at->format('d F Y H:i') }}</small>
            </div>
        @endif 
    </div>
</section>

@endsection 

@push('addon-script')

@endpush 