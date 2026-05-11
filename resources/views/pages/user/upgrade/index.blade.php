@extends('layouts.user.template')

@section('content')
  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <h1 class="text-uppercase fw-semibold">Membership</span>
        </div>
      </div>
    </div>
  </section>

  <!-- BLOG LIST -->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title my-2">
                Membership Status
              </h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Name</label>
                  <div class="col-sm-10">
                    <h6>Hanas Bayu Pratama</h6>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Username</label>
                  <div class="col-sm-10">
                    <h6>hanasbp</h6>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Email</label>
                  <div class="col-sm-10">
                    <h6>hanasoke@gmail.com</h6>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Access</label>
                  <div class="col-sm-10">
                    <span class="badge text-bg-secondary">
                      FREE
                    </span>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <a href="{{ route('edit_membership') }}" class="btn btn-success float-end">Upgrade Membership</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection