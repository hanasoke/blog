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
                <h5 class="card-title">Full Name</h5>
                <div class="mb-3 row">
                  <label for="username" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="username" value="hanasoke">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="email" value="email@example.com">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="phone" value="2321312312">
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="birthdate" class="col-sm-2 col-form-label">Birthdate</label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="birthdate" value="28 June 2021">
                  </div>
                </div>
                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection