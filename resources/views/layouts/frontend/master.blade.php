<!DOCTYPE html>
<html lang="en">
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

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('assets_frontend/css/bootstrap.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/font-awesome.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/themify-icons.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/magnific-popup.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/animate.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/owl.carousel.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_frontend/css/style.css')}}"/>


	{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/> --}}

	<!--[if lt IE 9]>
	  <script src="{{asset('assets_frontend/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
	  <script src="{{asset('assets_frontend/https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- header section -->
	<header class="header-section">
		<div class="container">
			
			<a href="index.html" class="site-logo"><img src="{{asset('assets_frontend/img/logo.png')}}" alt=""></a>
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<div class="header-info">
				<div class="hf-item">
					<i class="fa fa-clock-o"></i>
					<p><span>Working time:</span>Monday - Friday: 08 AM - 06 PM</p>
				</div>
				<div class="hf-item">
					<i class="fa fa-map-marker"></i>
					<p><span>Find us:</span>40 Baria Street 133/2, New York City, US</p>
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
					<a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Masuk</a>
                    @if (Route::has('register'))
					<a href="{{route('register')}}"><i class="fa fa-registered" aria-hidden="true"></i> Daftar</a>
                    @endif
                    @else
					<a href="#">Login Sebagai (Member)</a>
					<a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Keluar</a>
					@endif
					
				
				
			</div>
			
			<ul class="main-menu">
			@guest
				<li><a href="#"><img src="{{asset('assets_frontend/img/logo.png')}}" alt=""></a></li>
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
		<div class="container footer-top">
			<div class="row">
				<!-- widget -->
				<div class="col-sm-6 col-lg-3 footer-widget">
					<div class="about-widget">
						<img src="{{asset('assets_frontend/img/logo-light.png')}}" alt="">
						<p>orem ipsum dolor sit amet, consecter adipiscing elite. Donec minos varius, viverra justo ut, aliquet nisl.</p>
						<div class="social pt-1">
							<a href=""><i class="fa fa-twitter-square"></i></a>
							<a href=""><i class="fa fa-facebook-square"></i></a>
							<a href=""><i class="fa fa-google-plus-square"></i></a>
							<a href=""><i class="fa fa-linkedin-square"></i></a>
							<a href=""><i class="fa fa-rss-square"></i></a>
						</div>
					</div>
				</div>
				<!-- widget -->
				<div class="col-sm-6 col-lg-3 footer-widget">
					<h6 class="fw-title">USEFUL LINK</h6>
					<div class="dobule-link">
						<ul>
							<li><a href="">Home</a></li>
							<li><a href="">About us</a></li>
							<li><a href="">Services</a></li>
							<li><a href="">Events</a></li>
							<li><a href="">Features</a></li>
						</ul>
						<ul>
							<li><a href="">Policy</a></li>
							<li><a href="">Term</a></li>
							<li><a href="">Help</a></li>
							<li><a href="">FAQs</a></li>
							<li><a href="">Site map</a></li>
						</ul>
					</div>
				</div>
				<!-- widget -->
				<div class="col-sm-6 col-lg-3 footer-widget">
					<h6 class="fw-title">RECENT POST</h6>
					<ul class="recent-post">
						<li>
							<p>Snackable study:How to break <br> up your master's degree</p>
							<span><i class="fa fa-clock-o"></i>24 Mar 2018</span>
						</li>
						<li>
							<p>Open University plans major <br> cuts to number of staff</p>
							<span><i class="fa fa-clock-o"></i>24 Mar 2018</span>
						</li>
					</ul>
				</div>
				<!-- widget -->
				<div class="col-sm-6 col-lg-3 footer-widget">
					<h6 class="fw-title">CONTACT</h6>
					<ul class="contact">
						<li><p><i class="fa fa-map-marker"></i> 40 Baria Street 133/2, NewYork City,US</p></li>
						<li><p><i class="fa fa-phone"></i> (+88) 111 555 666</p></li>
						<li><p><i class="fa fa-envelope"></i> infodeercreative@gmail.com</p></li>
						<li><p><i class="fa fa-clock-o"></i> Monday - Friday, 08:00AM - 06:00 PM</p></li>
					</ul>
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
	<script src="{{asset('asset_dashboard/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('asset_dashboard/plugins/toastr/toastr.min.js')}}"></script>

<script src="{{asset('asset_dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset_dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('asset_dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('asset_dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
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
@if (session("error"))
    <script>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Error',
                body: '{{session("error")}}'
            })
    </script>
@endif

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

    <script>
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Error',
            body: '{{$message}}'
        })
    </script>

@endif

@yield('linkfooter')


</body>
</html>