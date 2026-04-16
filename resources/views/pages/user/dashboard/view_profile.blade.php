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
                <img src="{{ asset('storage/'.$user->photo) }}" class="img-fluid rounded-circle" alt="{{ $user->name }}" style="object-fit: cover;">
              @else 
                <img src="{{ asset('user_assets/icons/user.png') }}" class="img-fluid rounded-circle" alt="{{ $user->name }}" style="object-fit: cover;">
              @endif 
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col">
                    <h5 class="card-title">View Detail Profile</h5>
                  </div>
                  <div class="col text-end">
                    <a href="{{ route('edit_profile') }}" class="btn btn-outline-success"><img src="{{ asset('user_assets/icons/pencil-square.svg') }}" alt="Back"></a>
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

                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Full Name</label>
                  <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $user->name }}</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Username</label>
                  <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $user->username }}</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $user->email }}</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Phone</label>
                  <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $user->phone }}</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Birthdate</label>
                  <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($user->birthdate)->format('d F Y') }}</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Age</label>
                  <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($user->birthdate)->age }} years old</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Access Level</label>
                  <div class="col-sm-9">
                    <p class="form-control-plaintext">
                      <span class="badge bg-primary">{{ $user->access }}</span>
                    </p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Member Since</label>
                  <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($user->created_at)->format('d F Y') }}</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Last Updated</label>
                  <div class="col-sm-9">
                    <p class="form-control-plaintext">
                      <small class="text-muted">{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</small>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection