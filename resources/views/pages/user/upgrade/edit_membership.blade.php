@extends('layouts.user.template')

@section('content')
  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <h1 class="text-uppercase fw-semibold">Upgrade</span>
        </div>
      </div>
    </div>
  </section>

  <!-- BLOG LIST -->
  <section class="py-5">
    <div class="container">

      <!-- Alert Messages -->
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle-fill me-2"></i>
          <strong>Success!</strong> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <strong>Error!</strong> {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      
      @if($pendingTransaction && $pendingTransaction->status == 'PENDING')
        <div class="alert alert-warning">
          <i class="bi bi-clock-history me-2"></i>
          <strong>Pending Request!</strong> You already have a pending upgrade request to 
          <strong>{{ $pendingTransaction->member->name ?? 'N/A' }}</strong>.
          Please wait for admin approval before submitting another request.
        </div>
      @endif

      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="card shadow">
            <div class="card-header bg-primary text-white">
              <h5 class="card-title my-2">
                <i class="bi bi-arrow-up-circle me-2"></i> Upgrade to Membership Form 
              </h5>
            </div>
            <div class="card-body">
              <form action="{{ route('submit_upgrade') }}" method="POST" enctype="multipart/form-data" id="upgradeForm">
                @csrf 

                <!-- Current Membership Info -->
                <div class="alert alert-info mb-4">
                  <i class="bi bi-info-circle me-2"></i>
                  <strong>Current Membership:</strong> {{ $user->access }}
                  <br>
                  <small>Select a higher tier membership package below to upgrade.</small>
                </div>

                <!-- Membership Package -->
                <div class="mb-4">
                  <label class="form-label fw-bold">
                    Select Membership Package <span class="text-danger">*</span>
                  </label>
                  <div class="row g-3">
                    @foreach($members as $member) 
                      @php 
                        $isCurrent = ($user->access == $member->name);
                        $isDisabled = $isCurrent;
                        $cardClass = $isCurrent ? 'border-secondary bg-light' : 'border-primary';
                        $radioId = 'member_' . $member->id;
                      @endphp 
                      <div class="col-md-6">
                        <div class="card {{ $cardClass }} h-100">
                          <div class="card-body">
                            <div class="form-check">
                              <input class="form-check-input" 
                                      type="radio" 
                                      name="member_id" 
                                      id="{{ $radioId }}" 
                                      value="{{ $member->id }}"
                                      {{ $isDisabled ? 'disabled' : '' }}
                                      {{ old('member_id') == $member->id ? 'checked' : '' }}
                                      required>
                              <label class="form-check-label fw-bold fs-5" for="{{ $radioId }}">
                                {{ $member->name }}
                              </label>
                              @if($isCurrent)
                                <span class="badge bg-secondary ms-2">Current</span>
                              @endif
                              <div class="mt-2">
                                <h4 class="text-primary">Rp {{ number_format($member->price, 0, ',', '.') }}</h4>
                                <small class="text-muted">per month</small>
                              </div>
                              @if($member->name == 'VIP')
                                <div class="mt-2">
                                  <span class="badge bg-success">Recommended</span>
                                </div>
                              @endif
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
                  <select class="form-select @error('payment_id') is-invalid @enderror" name="payment_id">
                    <option value="">Select Payment Method</option>
                    @foreach($payments as $payment)
                      <option value="{{ $payment->id }}" {{ old('payment_id') == $payment->id ? 'selected' : '' }}>
                        {{ $payment->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('payment_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Account number -->
                <div class="mb-4">
                  <label class="form-label fw-bold">
                      Account Number <span class="text-danger">*</span>
                  </label>
                  <input type="number" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') }}" placeholder="Enter Your Account Number">
                  <small class="text-muted">Enter the account number you used for payment.</small>
                  @error('account_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror 
                </div>

                <!-- Payment Proof -->
                <div class="mb-4">
                  <label class="form-label fw-bold">
                      Payment Proof <span class="text-danger">*</span></label>
                  </label>
                  <input type="file" class="form-control @error('payment_proof') is-invalid @enderror" name="payment_proof" accept="image/*" id="paymentProof">

                  <small class="text-muted">Upload screenshot/photo of your payment transaction (Max 2MB, JPG/PNG).</small>
                  @error('payment_proof')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror

                  <!-- Image Preview -->
                  <div id="imagePreview" class="mt-3" style="display: none;">
                    <label class="fw-bold">Preview:</label>
                    <img id="previewImg" src="#" alt="Payment Proof Preview" class="img-thumbnail mt-1" style="max-width: 200px;">
                  </div>
                </div>

                <!-- Summary -->
                <div class="alert alert-secondary">
                  <h6 class="fw-bold mb-2"><i class="bi bi-receipt"></i> Order Summary</h6>
                  <div class="d-flex justify-content-between">
                    <span>Membership Package:</span>
                    <span id="summaryPackage" class="fw-bold">-</span>
                  </div>
                  <div class="d-flex justify-content-between mt-1">
                    <span>Price:</span>
                    <span id="summaryPrice" class="fw-bold text-primary">Rp 0</span>
                  </div>
                  <hr>
                  <div class="d-flex justify-content-between">
                    <span>Total Payment:</span>
                    <span id="summaryTotal" class="fw-bold text-success">Rp 0</span>
                  </div>
                </div>

                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-success btn-lg" id="submitBtn">
                    <i class="bi bi-send me-2"></i> Submit Upgrade Request 
                  </button>
                  <a href="{{ route('update_membership') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Back to Membership Status 
                  </a>
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
    // Get members data from PHP
    const members = @json($members);
    const currentAccess = '{{ $user->access }}';
    const hasPending = {{ $pendingTransaction ? 'true' : 'false' }};
    
    // Disable submit if has pending transaction
    if(hasPending) {
      $('#submitBtn').prop('disabled', true);
      $('#submitBtn').html('<i class="bi bi-hourglass-split me-2"></i> Pending Request - Please Wait');
    }
    
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
    
    // Image preview
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
    
    // Form validation before submit
    $('#upgradeForm').on('submit', function(e) {
      const selectedMember = $('input[name="member_id"]:checked');
      if(selectedMember.length === 0) {
        e.preventDefault();
        alert('Please select a membership package.');
        return false;
      }
      
      const selectedPayment = $('select[name="payment_id"]').val();
      if(!selectedPayment) {
        e.preventDefault();
        alert('Please select a payment method.');
        return false;
      }
      
      const accountNumber = $('input[name="account_number"]').val();
      if(!accountNumber.trim()) {
        e.preventDefault();
        alert('Please enter your account number.');
        return false;
      }
      
      const paymentProof = $('input[name="payment_proof"]')[0].files[0];
      if(!paymentProof) {
        e.preventDefault();
        alert('Please upload your payment proof.');
        return false;
      }
      
      // Confirm submission
      const memberName = selectedMember.closest('.card').find('.form-check-label').text();
      if(!confirm(`Are you sure you want to upgrade to ${memberName} membership?\n\nThis request will be reviewed by admin.`)) {
        e.preventDefault();
        return false;
      }
    });
  });
</script>
@endpush