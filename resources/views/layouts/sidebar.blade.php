<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin <sup>nur</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        GENERAL
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a href="{{ url('/home') }}" class="nav-link collapsed">
            <i class="fas fa-fw fa-cog"></i>
            <span>Barang</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('/pembelian') }}" class="nav-link collapsed">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pembelian</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a href="{{ url('/penjualan') }}" class="nav-link collapsed">
            <i class="fas fa-fw fa-cog"></i>
            <span>Penjualan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        OTHER
    </div>

    <li class="nav-item">
        <a href="{{ url('/barang-pembelian') }}" class="nav-link collapsed">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Barang Dibeli</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('/barang-penjualan') }}" class="nav-link collapsed">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Barang Dijual</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('/kartu-stok') }}" class="nav-link collapsed">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Kartu Stok</span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        {{-- <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Keluar</span></a> --}}
        <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-table"></i>
            <span>Keluar</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    {{-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('startbootstrap-sb-admin-2') }}/img/undraw_rocket.svg"
            alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!
        </p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> --}}

</ul>
