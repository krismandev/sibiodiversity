@extends("layouts.frontend.master")
@section("title","Berita")
@section("content")
<!-- Breadcrumb section -->
<div class="site-breadcrumb">
	<div class="container">
		<a href="#"><i class="fa fa-home"></i> Beranda</a> <i class="fa fa-angle-right"></i>
		<span>Berita</span>
	</div>
</div>
<!-- Breadcrumb section end -->


<!-- Blog page section  -->
<section class="blog-page-section spad pt-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 post-list">
				<div class="post-item">
					<div class="post-thumb set-bg" data-setbg="{{asset('assets_frontend/img/blog/1.jpg')}}"></div>
					<div class="post-content">
						<h3><a href="single-blog.html">Parents who try to be their children’s best friends</a></h3>
						<div class="post-meta">
							<span><i class="fa fa-calendar-o"></i> 23 Mar 2018</span>
							<span><i class="fa fa-user"></i> Cathrine Zeta</span>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel urna eget lectus molestie rhoncus sed in nunc. Vestib tincidunt facilisis ligula sed viverra. Duis porttitor sapien maximus, volutpat massa malesuada. Curabitur orci est, molestie eget orci, tincidunt dictum felis. Cras ante nunc, pharetra eu rutrum aliquet, gestas eget ex. Suspendisse potenti vietlott Quisque asvitae eros efficitur lacus viverra molestie at ut mi. Quisque id mollis nibh...</p>
					</div>
				</div>
				<div class="post-item">
					<div class="post-thumb set-bg" data-setbg="{{asset('assets_frontend/img/blog/2.jpg')}}"></div>
					<div class="post-content">
						<h3><a href="single-blog.html">Graduations could be delayed as external examiners</a></h3>
						<div class="post-meta">
							<span><i class="fa fa-calendar-o"></i> 23 Mar 2018</span>
							<span><i class="fa fa-user"></i> Cathrine Zeta</span>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel urna eget lectus molestie rhoncus sed in nunc. Vestibulum tincidunt facilisis ligula sed viverra. Duis porttitor sapien maximus, volutpat massa malesuada. Curabitur orci est, ut molestie eget orci, tincidunt dictum felis. Cras ante nunc, pharetra eu rutrum aliquet, egestas eget ex. Suspendisse potenti. Quisque asvitae eros efficitur lacus viverra molestie at ut mi. Quisque id mollis nibh...</p>
					</div>
				</div>
				<div class="post-item">
					<div class="post-thumb set-bg" data-setbg="{{asset('assets_frontend/img/blog/3.jpg')}}"></div>
					<div class="post-content">
						<h3><a href="single-blog.html">Private schools adopt a Ucas-style application system</a></h3>
						<div class="post-meta">
							<span><i class="fa fa-calendar-o"></i> 23 Mar 2018</span>
							<span><i class="fa fa-user"></i> Cathrine Zeta</span>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel urna eget lectus molestie rhoncus sed in nunc. Vestibulum tincidunt facilisis ligula sed viverra. Duis porttitor sapien maximus, volutpat massa malesuada. Curabitur orci est, ut molestie eget orci, tincidunt dictum felis. Cras ante nunc, pharetra eu rutrum aliquet, egestas eget ex. Suspendisse potenti. Quisque asvitae eros efficitur lacus viverra molestie at ut mi. Quisque id mollis nibh...</p>
					</div>
				</div>
				<div class="post-item">
					<div class="post-thumb set-bg" data-setbg="{{asset('assets_frontend/img/blog/4.jpg')}}"></div>
					<div class="post-content">
						<h3><a href="single-blog.html">Cambridge digs in at the top of university league table</a></h3>
						<div class="post-meta">
							<span><i class="fa fa-calendar-o"></i> 23 Mar 2018</span>
							<span><i class="fa fa-user"></i> Cathrine Zeta</span>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vel urna eget lectus molestie rhoncus sed in nunc. Vestibulum tincidunt facilisis ligula sed viverra. Duis porttitor sapien maximus, volutpat massa malesuada. Curabitur orci est, ut molestie eget orci, tincidunt dictum felis. Cras ante nunc, pharetra eu rutrum aliquet, egestas eget ex. Suspendisse potenti. Quisque asvitae eros efficitur lacus viverra molestie at ut mi. Quisque id mollis nibh...</p>
					</div>
				</div>
				<ul class="site-pageination">
					<li><a href="#" class="active">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
				</ul>
			</div>
			<!-- sidebar -->
			<div class="col-sm-8 col-md-5 col-lg-4 col-xl-3 offset-xl-1 offset-0 pl-xl-0 sidebar">
				<!-- widget -->
				<div class="widget">
					<form class="search-widget">
						<input type="text" placeholder="Search...">
						<button><i class="ti-search"></i></button>
					</form>
				</div>
				<!-- widget -->
				<div class="widget">
					<h5 class="widget-title">Recent News</h5>
					<div class="recent-post-widget">
						<!-- recent post -->
						<div class="rp-item">
							<div class="rp-thumb set-bg" data-setbg="{{asset('assets_frontend/img/blog/recent-post/1.jpg')}}"></div>
							<div class="rp-content">
								<h6>Snackable study:How to break up your master's degree</h6>
								<p><i class="fa fa-clock-o"></i> 24 Mar 2018</p>
							</div>
						</div>
						<!-- recent post -->
						<div class="rp-item">
							<div class="rp-thumb set-bg" data-setbg="{{asset('assets_frontend/img/blog/recent-post/2.jpg')}}"></div>
							<div class="rp-content">
								<h6>Op en University plans major ts to number of staff</h6>
								<p><i class="fa fa-clock-o"></i> 24 Mar 2018</p>
							</div>
						</div>
						<!-- recent post -->
						<div class="rp-item">
							<div class="rp-thumb set-bg" data-setbg="{{asset('assets_frontend/img/blog/recent-post/3.jpg')}}"></div>
							<div class="rp-content">
								<h6>My postgrad: ‘I worked on essays as giraffes walked by’</h6>
								<p><i class="fa fa-clock-o"></i> 24 Mar 2018</p>
							</div>
						</div>
						<!-- recent post -->
						<div class="rp-item">
							<div class="rp-thumb set-bg" data-setbg="{{asset('assets_frontend/img/blog/recent-post/4.jpg')}}"></div>
							<div class="rp-content">
								<h6>How to use the Guardian University Guide</h6>
								<p><i class="fa fa-clock-o"></i> 24 Mar 2018</p>
							</div>
						</div>
						<!-- recent post -->
						<div class="rp-item">
							<div class="rp-thumb set-bg" data-setbg="{{asset('assets_frontend/img/blog/recent-post/5.jpg')}}"></div>
							<div class="rp-content">
								<h6>My MBA experience: ‘It was an eye opener’</h6>
								<p><i class="fa fa-clock-o"></i> 24 Mar 2018</p>
							</div>
						</div>
						<!-- recent post -->
						<div class="rp-item">
							<div class="rp-thumb set-bg" data-setbg="{{asset('assets_frontend/img/blog/recent-post/6.jpg')}}"></div>
							<div class="rp-content">
								<h6>My MBA experience: ‘It was an eye opener’</h6>
								<p><i class="fa fa-clock-o"></i> 24 Mar 2018</p>
							</div>
						</div>
					</div>
				</div>
				<!-- widget -->
				<div class="widget">
					<h4 class="widget-title">Tags</h4>
					<div class="tags">
						<a href="#">DEVELOPMENT</a>
						<a href="#">BUSINESS</a>
						<a href="#">PROJECTS</a>
						<a href="#">GOOGLE ADWORDS</a>
						<a href="#">SQL DATABASE</a>
						<a href="#">MARKETING</a>
						<a href="#">DESIGN</a>
					</div>
				</div>
				<!-- widget -->
				<div class="widget">
					<h4 class="widget-title">Categories</h4>
					<ul>
						<li><a href="">Business</a></li>
						<li><a href="">Design</a></li>
						<li><a href="">Management</a></li>
						<li><a href="">Marketing Plans</a></li>
						<li><a href="">Construction</a></li>
						<li><a href="">Honored</a></li>
						<li><a href="">Program development</a></li>
						<li><a href="">My SQL database</a></li>
						<li><a href="">Google Adwords</a></li>
						<li><a href="">Education</a></li>
					</ul>
				</div>
				<!-- widget -->
				<div class="widget">
					<img src="{{asset('assets_frontend/img/ad.jpg')}}" alt="">
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Blog page section end -->

@endsection