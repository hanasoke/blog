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
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-2">
                Upgrade to Membership
              </h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">
                <form>
                  <div class="mb-3">
                    <label for="Account Number" class="form-label">
                        Account Number
                    </label>
                    <input type="number" class="form-control" id="Account Number">
                  </div>

                  <div class="mb-3">
                    <label for="Account Number" class="form-label">
                      Membersip Grade 
                    </label>
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="inputGroupSelect01">Options</label>
                      <select class="form-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="1">BASIC - Rp 10.000</option>
                        <option value="2">PREMIUM - Rp 15.000</option>
                        <option value="3">VIP - Rp.20.000</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="Payment Proof" class="form-label">
                        Account Number
                    </label>
                    <input type="number" class="form-control" id="Account Number">
                  </div>

                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" type="button">Submit</button>
                  </div>
                </form>
              </h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection