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

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title my-2">
                <i class="bi bi-person-badge me-2"></i> Membership Status
              </h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Name</label>
                  <div class="col-sm-10">
                    <h6>
                      {{ $user->name }}
                    </h6>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Username</label>
                  <div class="col-sm-10">
                    <h6>{{ $user->username }}</h6>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Email</label>
                  <div class="col-sm-10">
                    <h6>{{ $user->email }}</h6>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Current Access</label>
                  <div class="col-sm-10">
                    @php 
                      $badgeClass = 'secondary';
                      switch($user->access) {
                        case 'FREE': $badgeClass = 'secondary'; break;
                        case 'BASIC': $badgeClass = 'success'; break;
                        case 'PREMIUM': $badgeClass = 'warning'; break;
                        case 'VIP': $badgeClass = 'primary'; break;
                      }
                    @endphp 
                    <span class="badge text-bg-{{ $badgeClass }}">
                      {{ $user->access }}
                    </span>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                @if($pendingTransaction && $pendingTransaction->status == 'PENDING')
                  <div class="alert alert-warning mt-3">
                    <i class="bi bi-clock-history me-2"></i>
                    <strong>Pending Request!</strong> You have a pending upgrade request to 
                    <strong>{{ $pendingTransaction->member->name ?? 'N/A' }}</strong>.
                    Please wait for admin approval.
                  </div>
                @endif
                <a href="{{ route('edit_membership') }}" class="btn btn-success float-end">Upgrade Membership</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection