@extends("layouts.frontend.master")
@section("title",GoogleTranslate::trans('Detail Berita', app()->getLocale()))
@section("content")
<!-- Breadcrumb section -->
<div class="site-breadcrumb">
	<div class="container">
		<a href="{{route('home.frontend')}}"><i class="fa fa-home"></i>{{GoogleTranslate::trans('Beranda', app()->getLocale())}}</a> <i class="fa fa-angle-right"></i>
		<a href="{{route('berita.frontend')}}"> {{GoogleTranslate::trans('Berita', app()->getLocale())}}</a> <i class="fa fa-angle-right"></i>
		<span>{{GoogleTranslate::trans('Detail Berita', app()->getLocale())}}</span>
	</div>
</div>
<!-- Breadcrumb section end -->
<!-- Blog page section  -->
<section class="blog-page-section spad pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-item post-details">
                    <img src="{{$berita->getBerita()}}" class="post-thumb-full" alt="">
                    <div class="post-content">
                        <h3><a href="{{url('/berita-detail/'.$berita->id)}}">{{ GoogleTranslate::trans($berita->judul, app()->getLocale()) }}</a></h3>
                        <div class="post-meta">
                            <span><i class="fa fa-calendar-o"></i> {{ GoogleTranslate::trans($berita->created_at, app()->getLocale()) }}</span>
                            <span><i class="fa fa-user"></i> Admin</span>
                        </div>
                        <p>{!! GoogleTranslate::trans($berita->isi, app()->getLocale())  !!}</p>
                    </div>

                </div>
                <div class="navigation-area">
                  <div class="row">
                      @if (isset($previous))
                      <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                          <div class="detials">
                              <p>Prev Berita</p>
                              <a href="{{url('/berita-detail/'.$berita->previous()->id)}}"><h4>{{$berita->previous()->judul}}</h4></a>
                          </div>
                      </div>
                      @else
                      <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                          <div class="detials">
                              <p>Prev Berita</p>
                              <a href="#"><h4>-</h4></a>
                          </div>
                      </div>
                      @endif
                      @if (isset($next))
                      <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                          <div class="detials">
                              <p>Next Berita</p>
                              <a href="{{url('/berita-detail/'.$berita->next()->id)}}"><h4>{{$berita->next()->judul}}</h4></a>
                          </div>
                      </div>
                      @else
                      <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                          <div class="detials">
                              <p>Next Berita</p>
                              <a href="#"><h4>-</h4></a>
                          </div>
                      </div>
                      @endif
                  </div>
                </div>
            </div>
            <!-- sidebar -->
            <div class="col-sm-8 col-md-5 col-lg-4 col-xl-3 offset-xl-1 offset-0 pl-xl-0 sidebar">
                <!-- widget -->
                <!-- <div class="widget">
                    <form class="search-widget">
                        <input type="text" placeholder="Search...">
                        <button><i class="ti-search"></i></button>
                    </form>
                </div> -->
                <!-- widget -->
                <div class="widget">
                    <h5 class="widget-title">{{GoogleTranslate::trans('Berita Terbaru', app()->getLocale())}}</h5>

                    <div class="recent-post-widget">
						@forelse($berita_terbaru as $item)
						<!-- recent post -->
						<div class="rp-item">
							<div class="rp-thumb set-bg" data-setbg="{{$item->getBerita()}}"></div>
							<div class="rp-content">
								<h6><a href="{{url('/berita-detail/'.$item->id)}}">{{ GoogleTranslate::trans($item->judul, app()->getLocale())}}</a></h6>
								<p><i class="fa fa-clock-o"></i> {{GoogleTranslate::trans($item->created_at, app()->getLocale())}}</p>
							</div>
						</div>
						@empty
						<p> {{GoogleTranslate::trans('Belum Ada Berita Terbaru', app()->getLocale())}}</p>
						@endforelse

					</div>
                </div>

                <!-- widget -->
                <div class="widget">
                    <img src="img/ad.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog page section end -->
@endsection
