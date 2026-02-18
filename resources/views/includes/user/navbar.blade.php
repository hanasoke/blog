<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Untitled UI</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto gap-3">
        <li class="nav-item"><a class="nav-link" href="url{{'/'}}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Solutions</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>

        {{-- 🔒 BELUM LOGIN --}}
        @guest 
          <li class="nav-item"><a class="btn btn-outline-light rounded-pill px-4" href="{{ url('login') }}">Login</a></li>
        @endguest 

        {{-- ✅ SUDAH LOGIN --}}
        @auth
          <li class="nav-item dropdown">
            <a class="btn btn-outline-light dropdown-toggle rounded-pill px-4"
               href="#"
               role="button"
               data-bs-toggle="dropdown">
              {{ Auth::user()->name }}
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ url('/home') }}">Dashboard</a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
              </li>
            </ul>
          </li>
          <!-- Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="logoutModalLabel">Konfirmasi Logout</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Apakah Kamu yakin ingin keluar 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                      <button class="btn btn-primary">Keluar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endauth
      </ul>
    </div>
  </div>
</nav>