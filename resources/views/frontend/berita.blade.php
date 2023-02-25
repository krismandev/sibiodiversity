@extends("layouts.frontend.master")
@section("title",GoogleTranslate::trans('Berita', app()->getLocale()))
@section("content")
<!-- Breadcrumb section -->
<div class="site-breadcrumb">
	<div class="container">
		<a href="{{route('home.frontend')}}"><i class="fa fa-home"></i> {{ GoogleTranslate::trans('Beranda', app()->getLocale()) }}</a> <i class="fa fa-angle-right"></i>
		<span>{{ GoogleTranslate::trans('Berita', app()->getLocale()) }}</span>
	</div>
</div>
<!-- Breadcrumb section end -->


<!-- Blog page section  -->
<section class="blog-page-section spad pt-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 post-list">
				@forelse($data_berita as $berita)
				<div class="post-item">

					<div class="post-thumb set-bg" data-setbg="{{$berita->getBerita()}}"></div>
					<div class="post-content">
						<h3><a href="{{url('/berita-detail/'.$berita->id)}}">{{ GoogleTranslate::trans($berita->judul, app()->getLocale()) }}</a></h3>
						<div class="post-meta">
							<span><i class="fa fa-calendar-o"></i> {{ GoogleTranslate::trans( $berita->created_at, app()->getLocale())}}</span>
							<span><i class="fa fa-user"></i> Admin</span>
						</div>
						<p>{!! GoogleTranslate::trans(Str::limit($berita->isi,500), app()->getLocale()) !!} </p>
					</div>
				</div>
				@empty
				<h5> {{GoogleTranslate::trans('Belum ada berita', app()->getLocale())}} </h5>
				@endforelse
				<ul class="site-pageination">
					{{$data_berita->links()}}
				</ul>
			</div>
			<!-- sidebar -->
			<div class="col-sm-8 col-md-5 col-lg-4 col-xl-3 offset-xl-1 offset-0 pl-xl-0 sidebar">
				<!-- widget -->
				<div class="widget">
					<form class="search-widget"  action="/cari-berita" method="get">
						<input type="text" name="cari" placeholder="Cari Berita...">
						<button><i class="ti-search"></i></button>
					</form>
				</div>
				<!-- widget -->
				<div class="widget">
					<h5 class="widget-title"> {{GoogleTranslate::trans('Berita Terbaru', app()->getLocale()) }}</h5>
					<div class="recent-post-widget">
						@forelse($berita_terbaru as $item)
						<!-- recent post -->

						<div class="rp-item">
							<div class="rp-thumb set-bg" data-setbg="{{$item->getBerita()}}"></div>
							<div class="rp-content">
								<h6><a href="{{url('/berita-detail/'.$item->id)}}">{{ GoogleTranslate::trans($item->judul, app()->getLocale()) }}</a></h6>
								<p><i class="fa fa-clock-o"></i> {{$item->created_at}}</p>
							</div>
						</div>
						@empty
						<p>  {{GoogleTranslate::trans('Belum ada berita terbaru', app()->getLocale()) }}</p>
						@endforelse

					</div>
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
