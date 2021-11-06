    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin-dashboard')}}">
          <div class="sidebar-brand-icon">
            <!-- <img src="img/logo/logo2.png"> -->
          </div>
          <div class="sidebar-brand-text mx-3">
            <img src="/img/logo.jpeg" width="200" alt="">
          </div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
          <a class="nav-link" href="{{route('admin-dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Menu
        </div>
        <li class="nav-item">
          <a class="nav-link" href="/admin/kategori/">
            <i class="fas fa-fw fa-th-list"></i>
            <span>Kategori</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/produk/">
            <i class="fas fa-fw fa-cocktail"></i>
            <span>Produk</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/transaksi">
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>Transaksi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/kasir">
            <i class="fas fa-fw fa-users"></i>
            <span>Kasir</span>
          </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Authentication
        </div>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>Logout</span>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
          </a>
        </li>
      </ul>
      <!-- Sidebar -->