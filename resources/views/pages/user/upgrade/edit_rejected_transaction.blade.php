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

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="card-title my-2">
                            <i class="bi bi-pencil-square me-2"></i> Edit Your Upgrade Request 
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Previous Request:</strong> {{ $transaction->member->name }} (Rp {{ number_format($transaction->member->price, 0, ',', '.') }}) 
                            <br>
                            <small>Please fix the issues mentioned above and resubmit your request.</small>
                        </div>

                        <form action="{{ route('update_rejected_transaction', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            @method('PUT')

                            <!-- Membership Package -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Select Membership Package <span class="text-danger">*</span></label>
                                <div class="row g-3">
                                    @foreach($members as $member)
                                        @php 
                                            $isCurrent = ($transaction->member_id == $member->id);
                                            $cardClass = $isCurrent ? 'border-warning bg-light' : 'border-primary';
                                        @endphp 

                                        <div class="col-md-6">
                                            <div class="card {{ $cardClass }} h-100">
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="member_id" id="member_{{ $member->id }}" value="{{ $member->id }}" {{ $isCurrent ? 'checked' : '' }} required>
                                                        <label class="form-check-label fw-bold fs-5" for="member_{{ $member->id }}">
                                                            {{ $member->name }}
                                                        </label>
                                                        @if($isCurrent)
                                                            <span class="badge bg-warning ms-2">Previous Selection</span>
                                                        @endif 
                                                        <div class="mt-2">
                                                            <h4 class="text-primary">Rp {{ number_format($member->price, 0, ',', '.') }}</h4>
                                                            <small class="text-muted">per month</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('member_id')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror 
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection 

@push('addon-script')

@endpush 