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

                            <!-- Payment Method -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Payment Method <span class="text-danger">*</span></label>
                                <select class="form-select @error('payment_id') is-invalid @enderror" name="payment_id" required>
                                    <option value="">Select Payment Method</option>
                                    @foreach($payments as $payment)
                                        <option value="{{ $payment->id }}" {{ old('payment_id', $transaction->payment_id) == $payment->id ? 'selected' : '' }}>
                                            {{ $payment->name }}
                                        </option>
                                    @endforeach 
                                </select>
                                @error('payment_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <!-- Account Number -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Account Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number', $transaction->account_number) }}" placeholder="Enter Your Account Number" required>
                                <small class="text-muted">Enter the account number you used for payment.</small>
                                @error('accout_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror 
                            </div>

                            <!-- Payment Proof -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Payment Proof <span class="text-danger">*</span></label>

                                @if($transaction->payment_proof)
                                    <div class="mb-2">
                                        <label class="fw-bold">Current Payment Proof:</label>
                                        <div>
                                            <img src="{{ asset('storage/'.$transaction->payment_proof) }}" class="img-thumbnail" style="max-width: 200px;" alt="Current Payment Proof">
                                        </div>
                                        <small class="text-muted">Upload new file only if you want to change the payment proof.</small>
                                    </div>
                                @endif 

                                <input type="file" class="form-control @error('payment_proof') is-invalid @enderror" name="payment_proof" accept="image/*" id="paymentProof">

                                <small class="text-muted">Upload screenshot/photo of your payment transaction (Max 2MB, JPG/PNG). Leave empty to keep current proof.</small>

                                @error('payment_proof')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror 

                                <!-- Image Preview -->
                                 <div id="imagePreview" class="mt-3" style="display: none;">
                                    <label class="fw-bold">New Preview:</label>
                                    <img id="previewImg" src="$" alt="Payment Proof Preview" class="img-thumbnail mt-1" style="max-width: 200px;">
                                 </div>
                            </div>

                            <!-- Summary -->
                            <div class="alert alert-secondary">
                                <h6 class="fw-bold mb-2"><i class="bi bi-receipt"></i> Order Summary</h6>
                                <div class="d-flex justify-content-between">
                                    <span>Membership Package:</span>
                                    <span id="summaryPackage" class="fw-bold">{{ $transaction->member->name }}</span>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <span>Price:</span>
                                    <span id="summaryPrice" class="fw-bold text-primary">
                                        Rp {{ number_format($transaction->member->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span>Total Payment:</span>
                                    <span id="summaryTotal" class="fw-bold text-success">Rp {{ number_format($transaction->member->price, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="d-grip gap-2">
                                <a href="{{ route('update_membership') }}" class="btn btn-outline-secondary mt-2">
                                    <i class="bi bi-arrow-left me-2"></i> Back to Membership Status
                                </a>
                                <button type="submit" class="btn btn-warning mt-2">
                                    <i class="bi bi-send me-2"></i> Resubmit Request 
                                </button>
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
<script>
    $(document).ready(function() {
        const members = @json($members);
        
        // Update summary when member is selected
        $('input[name="member_id"]').on('change', function() {
            const memberId = $(this).val();
            const selectedMember = members.find(m => m.id == memberId);
            
            if(selectedMember) {
                const price = new Intl.NumberFormat('id-ID').format(selectedMember.price);
                $('#summaryPackage').text(selectedMember.name);
                $('#summaryPrice').text('Rp ' + price);
                $('#summaryTotal').text('Rp ' + price);
            }
        });
        
        // Image preview for new file
        $('#paymentProof').on('change', function(e) {
            const file = e.target.files[0];
            if(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImg').attr('src', e.target.result);
                    $('#imagePreview').show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#imagePreview').hide();
            }
        });
    });
</script>
@endpush 