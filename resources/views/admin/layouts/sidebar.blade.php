<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('purple/assets/images/fp.jpg') }}" alt="profile" />
                    <span class="login-status online"></span>
                </div>

                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">
                        {{ session('admin_nama') ?? 'Elfata' }}
                    </span>
                    <span class="text-secondary text-small">Administrator</span>
                </div>

                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-view-dashboard menu-icon"></i>
            </a>
        </li>

        <!-- Counter -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.counters.index') }}">
                <span class="menu-title">Counter</span>
                <i class="mdi mdi-home-city-outline menu-icon"></i>
            </a>
        </li>

        <!-- Staff -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.staff.index') }}">
                <span class="menu-title">Staff</span>
                <i class="mdi mdi-account-group-outline menu-icon"></i>
            </a>
        </li>

        <!-- Produk -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.products.index') }}">
                <span class="menu-title">Produk</span>
                <i class="mdi mdi-cube-outline menu-icon"></i>
            </a>
        </li>

        <!-- Promo -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.promo.index') }}">
                <span class="menu-title">Promo</span>
                <i class="mdi mdi-tag-multiple menu-icon"></i>
            </a>
        </li>

        <!-- Logout -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}" onclick="return confirm('Yakin ingin logout?')">
                <span class="menu-title">Logout</span>
                <i class="mdi mdi-logout menu-icon"></i>
            </a>
        </li>

    </ul>
</nav>
