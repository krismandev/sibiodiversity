<!-- Hero section -->
<section class="hero-section">
		<div class="hero-slider owl-carousel">
			@forelse($slider as $data_slider)
			<div class="hs-item set-bg" data-setbg="{{$data_slider->getSlider()}}">
				<div class="hs-text">
					<div class="container">
						<div class="row">
							<div class="col-lg-8">
								<div class="hs-subtitle" style="color:white">{{ GoogleTranslate::trans($data_slider->subtitle ?? '', app()->getLocale()) }} </div>
								<h2 class="hs-title">{{ GoogleTranslate::trans($data_slider->title ?? '', app()->getLocale()) }}</h2>
								<p class="hs-des">{!! GoogleTranslate::trans($data_slider->keterangan ?? '', app()->getLocale()) !!} </p>
								<div class="site-btn">{{ GoogleTranslate::trans('Mulai', app()->getLocale()) }}</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			@empty
			<div class="hs-item set-bg" data-setbg="{{asset('assets_frontend/img/hero-slider/1.jpg')}}">
				<div class="hs-text">
					<div class="container">
						<div class="row">
							<div class="col-lg-8">
								<div class="hs-subtitle">{{ GoogleTranslate::trans('Selamat datang di sibiodeversity', app()->getLocale()) }}</div>
								<h2 class="hs-title">{{ GoogleTranslate::trans('Ikan Sungai Batanghari.', app()->getLocale()) }}</h2>
								<div class="site-btn">{{ GoogleTranslate::trans('Mulai.', app()->getLocale()) }}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforelse

		</div>
	</section>
	<!-- Hero section end -->
