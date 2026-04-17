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

                @if(session('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <form action="{{ route('update_profile') }}" method="POST" enctype="multipart/form-data">
                  @csrf 
                  <div class="mb-3 row">
                    <label for="name" class="col-sm-3 col-form-label">Full Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                      @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>
                
                  <div class="mb-3 row">
                    <label for="username" class="col-sm-3 col-form-label">Username <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}">
                      @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                      @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="phone" class="col-sm-3 col-form-label">Phone <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                      @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="birthdate" class="col-sm-3 col-form-label">Birthdate <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}">
                      @error('birthdate')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror 
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <a href="{{ route('edit_profile') }}" class="btn btn-success">Update</a>
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