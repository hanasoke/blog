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
                <img src="{{ asset('storage/user.png') }}" class="img-fluid rounded-circle" alt="{{ $user->name }}" style="object-fit: cover;">
              @endif 
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">View Detail Profile</h5>
                <div class="mb-3 row">
                  <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="full_name" value="Hanas Bayu Pratama">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="username" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="username" value="hanasoke">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="email" value="hanasoke@gmail.com">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="phone" value="085819536158">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="birthdate" class="col-sm-2 col-form-label">Birthdate</label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="birthdate" value="28 June 2021">
                  </div>
                </div>
                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                <div class="mb-3 row">
                  <a href="{{ route('edit_profile') }}" class="btn btn-success">Edit Profile</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection