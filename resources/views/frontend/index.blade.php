@extends("layouts.frontend.master")
@section("title",GoogleTranslate::trans('Beranda', app()->getLocale()))
@section("content")
@include('layouts.frontend.hero')
<!-- About section -->
<section class="about-section spad pt-0 ">
		<div class="container mt-50">
			<div class="section-title text-center">
				<!-- <h3>WELCOME TO EZUCA</h3>
				<p>Let children creative and make a different</p> -->
			</div>
			<div class="row">

				<div class="col-lg-6 about-text">
					<h5>{{ GoogleTranslate::trans($judul, app()->getLocale()) }}</h5>
					@if(isset($tentang))
					<p>{!! GoogleTranslate::trans($tentang->isi, app()->getLocale()) !!}</p>
					@else
					<p>{{ GoogleTranslate::trans('Informasi Biodiversity Belum DiInputkan', app()->getLocale()) }}</p>
					@endif
					<!-- <h5 class="pt-4">Our history</h5>
					<p>Led at felis arcu. Integer lorem lorem, tincidunt eu congue et, mattis ut ante. Nami suscipit, lectus id efficitur ornare, leo libero convalis nulla, vitae dignissim .</p>
					<ul class="about-list">
						<li><i class="fa fa-check-square-o"></i> University Faculties organise teaching and research into individual subjects.</li>
						<li><i class="fa fa-check-square-o"></i> The University is rich in history - its famous buildings attract visitors.</li>
						<li><i class="fa fa-check-square-o"></i> 50 years of people, and achievements that continue to transform.</li>
						<li><i class="fa fa-check-square-o"></i> The University's core values are as follows:freedom of thought.</li>
					</ul> -->
				</div>
				<div class="col-lg-6 pt-5 pt-lg-0">
					@if(isset($tentang))

					<img src="{{$tentang->getTentang()}}" alt="">
					@else
					<img src="{{asset('assets_frontend/img/about.jpg')}}" alt="">
					@endif
				</div>
			</div>
		</div>
	</section>
	<!-- About section end-->

	<!-- Blog section -->
	<section class="blog-section spad">
		<div class="container">
			<div class="section-title text-center">
				<h3>{{ GoogleTranslate::trans('Berita Terbaru', app()->getLocale()) }}</h3>
				<p>{{ GoogleTranslate::trans('Dapatkan informasi terbaru disini!', app()->getLocale()) }}</p>
			</div>
			<div class="row">
				@forelse($data_berita as $berita)
				<div class="col-xl-6">
					<div class="blog-item">
						<div class="blog-thumb set-bg" data-setbg="{{$berita->getBerita()}}"></div>
						<div class="blog-content">
							<h4><a href="{{url('/berita-detail/'.$berita->id)}}">{{ GoogleTranslate::trans($berita->judul, app()->getLocale()) }}</a></h4>
							<div class="blog-meta">
								<span><i class="fa fa-calendar-o"></i> {{ GoogleTranslate::trans($berita->created_at, app()->getLocale()) }}</span>
								<span><i class="fa fa-user"></i>Admin</span>
							</div>
							<p>{!!  GoogleTranslate::trans(Str::limit($berita->isi,100), app()->getLocale())  !!}</p>
						</div>
					</div>
				</div>
				@empty
				<h4> {{ GoogleTranslate::trans('Tidak ada berita', app()->getLocale()) }}</h4>
				@endforelse
			</div>
		</div>
	</section>
	<!-- Blog section -->
    <div class="gallery-section" style="padding: 50px;">
        <div class="section-title text-center">
            <h3> {{ GoogleTranslate::trans('Mitra', app()->getLocale()) }} </h3>

        </div>
		<div class="gallery">
			<div class="grid-sizer"></div>
			<div class="gallery-item gi-big set-bg" data-setbg="{{asset('assets_frontend/img/gallery/unja.png')}}" style="padding: 10px;">
				<a class="img-popup" href="{{asset('assets_frontend/img/gallery/unja.png')}}"><i class="ti-plus"></i></a>
			</div>

			<div class="gallery-item gi-big set-bg" data-setbg="{{asset('assets_frontend/img/gallery/bpbat.jpg')}}" style="padding: 10px;">
				<a class="img-popup" href="{{asset('assets_frontend/img/gallery/bpbat.jpg')}}"><i class="ti-plus"></i></a>
			</div>
            <div class="gallery-item gi-big set-bg" data-setbg="{{asset('assets_frontend/img/gallery/bkipm.png')}}" style="padding: 10px;">
                <a class="img-popup" href="{{asset('assets_frontend/img/gallery/1.jpg')}}"><i class="ti-plus"></i></a>
            </div>
            <div class="gallery-item gi-big set-bg" data-setbg="{{asset('assets_frontend/img/gallery/kkp.png')}}" style="padding: 10px;">
                <a class="img-popup" href="{{asset('assets_frontend/img/gallery/kkp.png')}}"><i class="ti-plus"></i></a>
            </div>

		</div>
	</div>
    <br/>


@endsection

