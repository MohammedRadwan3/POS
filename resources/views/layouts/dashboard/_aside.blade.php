<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{url('/')}}/dashboardFiles/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('/')}}/dashboardFiles/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('dashboard.home') }}" class="nav-link {{ (request()->segment(3) == 'index') ? 'active' : '' }}">
                <i class="fa fa-th"></i>
              <p>
                @lang('site.dashboard')
              </p>
            </a>
          </li>
          @if (auth()->user()->hasPermission('read_users'))
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('dashboard.users.index') }}" class="nav-link {{ (request()->segment(3) == 'users') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
              <p>
                @lang('site.users')
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
