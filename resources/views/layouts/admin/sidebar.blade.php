<aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="brand-image" style="max-height: 40px;">DUA NAGA CORP
        <span class="brand-text" style="color: transparent">..</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MASTER DATA</li>

                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori Barang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('materials.index') }}" class="nav-link {{ request()->routeIs('materials.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>Data Barang</p>
                    </a>
                </li>

                @if(Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data User</p>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
