<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="RSHP Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">RSHP Unair</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel -->
      @auth
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
      @endauth

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Dashboard -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <!-- Data Master -->
          <li class="nav-header">DATA MASTER</li>
          
          <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Users</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.role.index') }}" class="nav-link {{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-shield-alt"></i>
              <p>Roles</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.pemilik.index') }}" class="nav-link {{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Pemilik</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.pet.index') }}" class="nav-link {{ request()->routeIs('admin.pet.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-paw"></i>
              <p>Pet</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.jenis-hewan.index') }}" class="nav-link {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-list"></i>
              <p>Jenis Hewan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.ras-hewan.index') }}" class="nav-link {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tags"></i>
              <p>Ras Hewan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-folder"></i>
              <p>Kategori</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.kategori-klinis.index') }}" class="nav-link {{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>Kategori Klinis</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="nav-link {{ request()->routeIs('admin.kode-tindakan-terapi.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-medical"></i>
              <p>Kode Tindakan Terapi</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>