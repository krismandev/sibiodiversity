@if(Route::is('home.frontend') )
   <!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
  <div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="index.html">Sibiodiversity</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav id="navbar" class="navbar">
      <ul>
      <li><a class="nav-link scrollto active" href="{{route('home.frontend')}}">Beranda</a></li>
        <li><a class="nav-link scrollto" href="{{route('explore.frontend')}}">Explore</a></li>
        <li><a class="nav-link scrollto" href="#services">Gallery</a></li>
        <li><a class="nav-link scrollto" href="#services">Berita</a></li>
        @if (Route::has('login'))
            @auth
              <li><a class="getstarted" href="{{ route('logout') }}">Keluar</a></li> 
            @else
                <li><a class="getstarted" href="{{ route('login') }}">Masuk</a></li> 

                @if (Route::has('register'))
                <li><a class="getstarted" href="{{ route('register') }}">Daftar</a></li> 
                @endif
            @endauth
        @endif
        <!-- <li class="dropdown"><a href="#"><span>Login</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="#">Drop Down 1</a></li>
            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="#">Deep Drop Down 1</a></li>
                <li><a href="#">Deep Drop Down 2</a></li>
                <li><a href="#">Deep Drop Down 3</a></li>
                <li><a href="#">Deep Drop Down 4</a></li>
                <li><a href="#">Deep Drop Down 5</a></li>
              </ul>
            </li>
            <li><a href="#">Drop Down 2</a></li>
            <li><a href="#">Drop Down 3</a></li>
            <li><a href="#">Drop Down 4</a></li>
          </ul>
        </li> -->
        <!-- <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        <li><a class="getstarted scrollto" href="#about">Get Started</a></li> -->
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->

@elseif (in_array(Route::currentRouteName(), ['explore.frontend']))
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Sibiodiversity</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
         <ul>
        <li><a class="nav-link scrollto active" href="{{route('home.frontend')}}">Beranda</a></li>
        <li><a class="nav-link scrollto" href="{{route('explore.frontend')}}">Explore</a></li>
        <li><a class="nav-link scrollto" href="#services">Gallery</a></li>
        <li><a class="nav-link scrollto" href="#services">Berita</a></li>
        @if (Route::has('login'))
            @auth
              <li><a class="getstarted" href="{{ route('logout') }}">Keluar</a></li> 
            @else
                <li><a class="getstarted" href="{{ route('login') }}">Masuk</a></li> 

                @if (Route::has('register'))
                <li><a class="getstarted" href="{{ route('register') }}">Daftar</a></li> 
                @endif
            @endauth
        @endif

       

        <!-- <li class="dropdown"><a href="#"><span>Login</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="#">Drop Down 1</a></li>
            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="#">Deep Drop Down 1</a></li>
                <li><a href="#">Deep Drop Down 2</a></li>
                <li><a href="#">Deep Drop Down 3</a></li>
                <li><a href="#">Deep Drop Down 4</a></li>
                <li><a href="#">Deep Drop Down 5</a></li>
              </ul>
            </li>
            <li><a href="#">Drop Down 2</a></li>
            <li><a href="#">Drop Down 3</a></li>
            <li><a href="#">Drop Down 4</a></li>
          </ul>
        </li> -->
        <!-- <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        <li><a class="getstarted scrollto" href="#about">Get Started</a></li> -->
      </ul>
       
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

@endif