<!-- Hero section -->
<section class="hero-section">
		<div class="hero-slider owl-carousel">
			@forelse($slider as $data_slider)
			<div class="hs-item set-bg" data-setbg="{{$data_slider->getSlider()}}">
				<div class="hs-text">
					<div class="container">
						<div class="row">
							<div class="col-lg-8">
								<div class="hs-subtitle">{{$data_slider->subtitle ?? ''}}</div>
								<h2 class="hs-title">{{$data_slider->title ?? ''}}</h2>
								<p class="hs-des">{!! $data_slider->keterangan ?? '' !!}</p>
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
								<div class="hs-subtitle">Award Winning UNIVERSITY</div>
								<h2 class="hs-title">An investment in knowledge pays the best interest.</h2>
								<p class="hs-des">Education is not just about going to school and getting a degree. It's about widening your<br> knowledge and absorbing the truth about life. Knowledge is power.</p>
								<div class="site-btn">GET STARTED</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforelse

		</div>
	</section>
	<!-- Hero section end -->