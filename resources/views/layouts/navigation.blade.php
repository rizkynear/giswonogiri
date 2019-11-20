<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="{{asset('backend/images/avatar.png')}}" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Selamat Datang,</span>
        <h2>{{Auth::user()->nama}}</h2>
      </div>
    </div>
    <br />

    @if (Request::is('admin/*'))
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>Menu</h3>
          <ul class="nav side-menu">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-home"></i> Dashboard </a></li>
            <li><a><i class="fa fa-book"></i> Kategori <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{url('admin/kategori/tambah-kategori')}}">Tambah Kategori</a></li>
                <li><a href="{{url('admin/kategori/data-kategori')}}">Kategori</a></li>
              </ul>
            </li>
            <li><a><i class="fa fa-book"></i> Wisata <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{url('admin/wisata/tambah-wisata')}}">Tambah Wisata</a></li>
                <li><a href="{{url('admin/wisata/data-wisata')}}">Wisata</a></li>
              </ul>
            </li>
            <li><a href="{{url('admin/peta/peta')}}"><i class="fa fa-map"></i> Peta Wisata </a></li>
          </ul>
        </div>
      @elseif (Request::is('super-admin/*'))
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>Menu</h3>
          <ul class="nav side-menu">
            <li><a href="{{url('super-admin/dashboard')}}"><i class="fa fa-home"></i> Dashboard </a></li>
            <li><a><i class="fa fa-book"></i> Admin <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{url('super-admin/admin/tambah-admin')}}">Tambah Admin</a></li>
                <li><a href="{{url('super-admin/admin/data-admin')}}">Admin</a></li>
              </ul>
            </li>
          </ul>
        </div>
      @endif

    </div>
    <!-- /sidebar menu -->
  </div>
</div>