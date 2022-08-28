<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('asset_dashboard/dist/img/AdminLTELogo.png')}}" alt="LOGO" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Sibiodiversity</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('asset_dashboard/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="{{route('home.dashboard')}}" class="nav-link {{(request()->is('home*'))?'active': ''}}">
                <i class="nav-icon fa fa-home"></i>
                <p>
                Home
                </p>
            </a>
            </li>
            @php
              $master_menu_active = (request()->is('dashboard/class*') || request()->is('dashboard/ordo*') || request()->is('dashboard/famili*') || request()->is('dashboard/genus*') || request()->is('dashboard/spesies*')) ? true : false;
            @endphp
            <li class="nav-item has-treeview {{$master_menu_active == true ? 'menu-open' : ''}}">
              <a href="#" class="nav-link {{$master_menu_active == true ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Master
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('class.index')}}" class="nav-link {{(request()->is('dashboard/class*'))?'active': ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Class</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('ordo.index')}}" class="nav-link {{(request()->is('dashboard/ordo*'))?'active': ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ordo</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('famili.index')}}" class="nav-link {{(request()->is('dashboard/famili*'))?'active': ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Famili</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('genus.index')}}" class="nav-link {{(request()->is('dashboard/genus*'))?'active': ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Genus</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('spesies.index')}}" class="nav-link {{(request()->is('dashboard/spesies*'))?'active': ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Spesies</p>
                  </a>
                </li>
              </ul>
          </li>
          
            <li class="nav-item">
            <a href="{{route('gallery.index')}}" class="nav-link {{(request()->is('dashboard/gallery*'))?'active': ''}}">
                <i class="nav-icon fa fa-video-camera"></i>
                <p>
               Gallery
                </p>
            </a>
            </li>
            <li class="nav-item">
            <a href="{{route('berita.index')}}" class="nav-link {{(request()->is('dashboard/berita*'))?'active': ''}}">
                <i class="nav-icon fa fa-newspaper-o"></i>
                <p>
               Berita
                </p>
            </a>
            </li>

            @php
              $setting_menu_active = (request()->is('dashboard/tentang*') || request()->is('dashboard/slider*')) ? true : false;
            @endphp
            <li class="nav-item has-treeview {{$setting_menu_active == true ? 'menu-open' : ''}}">
              <a href="#" class="nav-link {{$setting_menu_active == true ? 'active' : ''}}">
                <i class="nav-icon fa fa-cogs"></i>
                <p>
                  Pengaturan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('tentang.index')}}" class="nav-link {{(request()->is('dashboard/tentang*'))?'active': ''}}">
                    <i class="far fa fa-info-circle nav-icon"></i>
                    <p>Informasi Tentang</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('slider.index')}}" class="nav-link {{(request()->is('dashboard/slider*'))?'active': ''}}">
                    <i class="fa fa-sliders nav-icon"></i>
                    <p>Slider</p>
                  </a>
                </li>
              </ul>
              
          </li>
            <li class="nav-item">
                <a href="{{route('logout')}}" class="nav-link">
                <i class="nav-icon fa fa-sign-out"></i>
                <p>
                    Logout
                </p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>