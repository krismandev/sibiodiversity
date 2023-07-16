<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<meta name="description" content="Unica University Template">
	<meta name="keywords" content="event, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="{{asset('assets_frontend/img/favicon.ico')}}" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('asset_dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('assets_frontend/css/bootstrap.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/font-awesome.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/themify-icons.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/magnific-popup.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/animate.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/owl.carousel.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/style.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/jquery.fancybox.min.css')}}">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}

	{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/> --}}

	<!--[if lt IE 9]>
	  <script src="{{asset('assets_frontend/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
	  <script src="{{asset('assets_frontend/https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>

	<![endif]-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- header section -->
	<header class="header-section">
		<div class="container">

			<a href="index.html" class="site-logo"><img src="{{asset('assets_frontend/img/logo-menu3.png')}}" alt=""></a>
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<div class="header-info">
				<div class="hf-item">
					<!-- <i class="fa fa-clock-o"></i>
					<p><span>Working time:</span>Monday - Friday: 08 AM - 06 PM</p> -->
				</div>
				<div class="hf-item">
					<!-- <i class="fa fa-map-marker"></i>
					<p><span>Find us:</span>40 Baria Street 133/2, New York City, US</p> -->
				</div>
			</div>
		</div>
	</header>
	<!-- header section end-->


	<!-- Header section  -->
	<nav class="nav-section">
		<div class="container">
			<div class="nav-right">
					@guest
					<a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                    @if (Route::has('register'))
					<a href="{{route('register')}}"><i class="fa fa-registered" aria-hidden="true"></i>Register</a>
                    @endif
                    @else
					<a href="#">Login Sebagai (Member)</a>
					<a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
					@endif



			</div>

			<ul class="main-menu">
			@guest
				<li class="{{(request()->is('/*'))?'active': ''}}"><a href="{{route('home.frontend')}}">Beranda</a></li>
				<li class="{{(request()->is('explorer*'))?'active': ''}}"><a href="{{route('explorer.frontend')}}">Explorer</a></li>
				<li class="{{(request()->is('gallery*'))?'active': ''}}"><a href="{{route('gallery.frontend')}}">Gallery</a></li>
				<li class="{{(request()->is('berita*'))?'active': ''}}"><a href="{{route('berita.frontend')}}">Berita</a></li>
			@else
				<li class="{{(request()->is('/*'))?'active': ''}}"><a href="{{route('home.frontend')}}">Beranda</a></li>
				<li class="{{(request()->is('explorer*'))?'active': ''}}"><a href="{{route('explorer.frontend')}}">Explorer</a></li>
				<li class="{{(request()->is('gallery*'))?'active': ''}}"><a href="{{route('gallery.frontend')}}">Gallery</a></li>
				<li class="{{(request()->is('berita*'))?'active': ''}}"><a href="{{route('berita.frontend')}}">Berita</a></li>
				<li class="{{(request()->is('member*'))?'active': ''}}"><a href="{{route('member-explorer.index')}}">Tambah Spesies</a></li>
			@endif
			</ul>
		</div>
	</nav>
	<!-- Header section end -->



	@yield('content')




	<!-- Footer section -->
	<footer class="footer-section">
		<div class="footer-top">
		<div class="container">
			<div class="row">
			<div class="col-lg-4 col-md-4">
				<img src="{{asset('assets_frontend/img/about.png')}}" alt="" style="width: 300px; object-fit: cover; object-position: center;">
			</div>
			<div class="col-lg-6 col-md-6 footer-contact">
				<p>
					Jl. Jambi - Muara Bulian No.KM. 15, <br>
					Mendalo Darat, Kec. Jambi Luar Kota, <br>
					Kabupaten Muaro Jambi, Jambi <br><br>
				<strong>Phone:</strong> +628 xxx xxx xx<br>
				<strong>Email:</strong> ikanjambi@unja.ac.id<br>
				</p>

				<a href="https://info.flagcounter.com/itve"><img src="https://s11.flagcounter.com/count2/itve/bg_FFFFFF/txt_000000/border_CCCCCC/columns_2/maxflags_10/viewers_0/labels_0/pageviews_0/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
			</div>

			<div class="col-lg-2 col-md-6 footer-links">
				<ul>
					<li><i class="bx bx-chevron-right"></i> <a href="{{route('home.frontend')}}">Home</a></li>
					<li><i class="bx bx-chevron-right"></i> <a href="{{route('explorer.frontend')}}">Explorer</a></li>
					<li><i class="bx bx-chevron-right"></i> <a href="{{route('gallery.frontend')}}">Gallery</a></li>
					<li><i class="bx bx-chevron-right"></i> <a href="{{route('berita.frontend')}}">Berita</a></li>
				</ul>
			</div>

			<!-- <div class="col-lg-3 col-md-6 footer-links">
				<h4>Our Services</h4>
				<ul>
				<li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
				<li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
				<li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
				<li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
				<li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
				</ul>
			</div> -->

			<!-- <div class="col-lg-3 col-md-6 footer-links">
				<h4>Our Social Networks</h4>
				<p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
				<div class="social-links mt-3">
				<a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
				<a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
				<a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
				<a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
				<a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
				</div>
			</div> -->

			</div>
		</div>
		</div>
		<!-- copyright -->
		<div class="copyright">
			<div class="container">
				<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
			</div>
		</div>
	</footer>
	<!-- Footer section end-->



	<!--====== Javascripts & Jquery ======-->
	<script src="{{asset('assets_frontend/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets_frontend/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets_frontend/js/jquery.countdown.js')}}"></script>
	<script src="{{asset('assets_frontend/js/masonry.pkgd.min.js')}}"></script>
	<script src="{{asset('assets_frontend/js/magnific-popup.min.js')}}"></script>
	<script src="{{asset('assets_frontend/js/main.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.fancybox.min.js')}}"></script>
	<script src="{{asset('asset_dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> --}}
<script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
<script src="https://kit.fontawesome.com/ba5890d42b.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

@if (session("success"))
    <script>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Berhasil',
                body: '{{session("success")}}'
            })
    </script>
@endif
{{-- @if (session("error"))
    <script>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Error',
                body: '{{session("error")}}'
            })
    </script>
@endif --}}

@if ($errors->any())
    @php
        // dd($errors->all());
        $message = '';
    @endphp
    @foreach ($errors->all() as $error)
        @php
            $message .= $error.", ";
        @endphp
    @endforeach

    {{-- <script>
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Error',
            body: '{{$message}}'
        })
    </script> --}}

@endif

@yield('linkfooter')


</body>
</html>
