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
              <div class="card-subtitle mb-2 text-body-secondary">
                <form>
                  <div class="mb-3">
                    <label for="Account Number" class="form-label">
                        Account Number
                    </label>
                    <input type="number" class="form-control" id="Account Number" placeholder="Input Your Account Number">
                  </div>

                  <div class="my-3">
                    <label for="Account Number" class="form-label">
                      Membersip Grade 
                    </label>
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="options">Options</label>
                      <select class="form-select" id="options">
                        <option selected>Choose...</option>
                        <option value="1">BASIC - Rp 10.000</option>
                        <option value="2">PREMIUM - Rp 15.000</option>
                        <option value="3">VIP - Rp 20.000</option>
                      </select>
                    </div>
                  </div>

                  <div class="my-3">
                    <label for="wallet" class="form-label">
                      Wallet 
                    </label>
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="options">Options</label>
                      <select class="form-select" id="options">
                        <option selected>Choose...</option>
                        <option value="dana">DANA</option>
                        <option value="ovo">OVO</option>
                        <option value="jenius">Jenius</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="payment_proof" class="form-label">
                        Payment Proof
                    </label>
                    <input type="file" class="form-control" id="payment_proof">
                  </div>

                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" type="button">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-2">
                Waiting for Admin Decision
              </h5>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-2">
                You must fix the problem
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection