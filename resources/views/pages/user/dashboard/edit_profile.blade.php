@extends('layouts.user.template')

@section('content')
  <!-- BLOG LIST -->
  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="..." class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col">
                    <h5 class="card-title" class="float-start">Edit Profile</h5>
                  </div>
                  <div class="col">
                    <a href="{{ route('profile') }}" class="btn btn-secondary float-end">Back</a>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="full_name" value="Hanas Bayu Pratama">
                  </div>
                </div>
                
                <div class="mb-3 row">
                  <label for="username" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" value="hanasoke">
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" value="sukijan@gmail.com">
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" value="085819536158">
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="phone" class="col-sm-2 col-form-label">Birthdate</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="phone" value="1 July 2026">
                  </div>
                </div>

                <div class="mb-3 row">
                  <a href="{{ route('edit_profile') }}" class="btn btn-success">Update</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection