<!-- Hero section -->
<section class="hero-section">
		<div class="hero-slider owl-carousel">
			@forelse($slider as $data_slider)
			<div class="hs-item set-bg" data-setbg="{{$data_slider->getSlider()}}">
				<div class="hs-text">
					<div class="container">
						<div class="row">
							<div class="col-lg-8">
								<div class="hs-subtitle" style="color:white">{{ $data_slider->subtitle ?? '' }} </div>
								<h2 class="hs-title">{{ $data_slider->title ?? ''}}</h2>
								<p class="hs-des">{!! $data_slider->keterangan ?? '' !!} </p>
								<div class="site-btn">Mulai</div>
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
								<div class="hs-subtitle">Selamat datang di sibiodeversity</div>
								<h2 class="hs-title">Ikan Sungai Batanghari</h2>
								<div class="site-btn">Mulai.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforelse

		</div>
	</section>
	<!-- Hero section end -->
