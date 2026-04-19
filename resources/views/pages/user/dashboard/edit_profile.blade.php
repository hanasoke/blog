@extends('layouts.user.template')

@section('content')
  <!-- BLOG LIST -->
  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4 text-center p-4">
              @if($user->photo)
                <img src="{{ asset('storage/'.$user->photo) }}" id="photoPreview" class="img-fluid rounded-circle" alt="{{ $user->name }}" style="width: 200px; height:200px; object-fit: cover;">
              @else 
                <img src="{{ asset('user_assets/icons/user.png') }}" class="img-fluid rounded-circle" alt="{{ $user->name }}" style="object-fit: cover;">
              @endif 
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col">
                    <h5 class="card-title">Edit Profile</h5>
                  </div>
                  <div class="col text-end">
                    <a href="{{ route('profile') }}" class="btn btn-outline-secondary float-end"><img src="{{ asset('user_assets/icons/arrow-left.svg') }}" alt="Back"></a>
                  </div>
                </div>

                @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                @if(session('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                  @csrf 
                  <div class="mb-3 row">
                    <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                      @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>
                
                  <div class="mb-3 row">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}">
                      @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                      @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                      @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="birthdate" class="col-sm-3 col-form-label">Birthdate</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('Y-m-d') : '') }}">
                      @error('birthdate')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="photo" class="col-sm-3 col-form-label">Photo</label>
                    <div class="col-sm-9">
                      <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                      <small class="text-muted">Max: 2MB (JPG, JPEG, PNG)</small>
                      @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <hr class="my-4">

                  <h6 class="mb-3">Change Password (Optional)</h6>

                  <div class="mb-3 row">
                    <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">

                      @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="new_password" class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">

                      @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="new_password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <div class="col-sm-9 offset-sm-3">
                      <button type="submit" class="btn btn-success float-end">Update Profile</button>
                      <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('addon-script')
<script>
  // Preview photo before upload 
  document.getElementById('photo').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('photoPreview').src = e.target.result;
    }
    if(this.files && this.files[0]) {
      reader.readAsDataURL(this.files[0]);
    }
  });

  // Phone number validation (only numbers)
  document.getElementById('phone').addEventListener('input', function(e){
    this.value = this.value.replace(/\D/g, '');
  });

  // Format Birthdate display
  const birthdateInput = document.getElementById('birthdate');
  if(birthdateInput && birthdateInput.value) {
    // Ensure date is in YYYY-MM-DD format
    const date = new Date(birthdateInput.value);
    if(!isNaN(date.getTime())) {
      const year = date.getFullYear();
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const day = String(date.getDate()).padStart(2, '0');
      birthdateInput.value = `${year}-${month}-${day}`;
    }
  }
</script>
@endpush 