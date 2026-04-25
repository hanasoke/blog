<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Blog</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Blog Menu 
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#blogs"
            aria-expanded="true" aria-controls="blogs">
            <i class="fas fa-fw fa-book"></i>
            <span>Blogs</span>
        </a>
        <div id="blogs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Blogs Component</h6>
                <a class="collapse-item" href="{{ route('sources_list') }}">Sources Data View</a>
                <a class="collapse-item" href="{{ route('genre_lists') }}">Genre Data View</a>
                <a class="collapse-item" href="{{ route('blogs_data') }}">Blogs Data View</a>
                <a class="collapse-item" href="{{ route('access_blogs') }}">Access Blogs</a>
            </div>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payment"
            aria-expanded="true" aria-controls="payment">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Payment</span>
        </a>
        <div id="payment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Payment View</h6>
                <a class="collapse-item" href="{{ route('add_payment') }}">Add Payment</a>
                <a class="collapse-item" href="{{ route('payment') }}">Payment List</a>
            </div>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaction"
            aria-expanded="true" aria-controls="transaction">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Transaction</span>
        </a>
        <div id="transaction" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaction View</h6>
                <a class="collapse-item" href="#">Pending Transaction</a>
                <a class="collapse-item" href="#">Reject Transaction</a>
                <a class="collapse-item" href="#">Accept Transaction</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users_list') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Users Data</span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('article_status') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Article Status</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->