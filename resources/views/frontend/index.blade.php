@extends("layouts.frontend.master")
@section("title","Beranda")
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
					<h5>About us</h5>
					<p>Lorem ipsum dolor sitdoni amet, consectetur dont adipis elite. Vivamus interdum ultrices augue. Aenean dos cursus lania. Duis et fringilla leonardo. Mauris mattis phare sem, debut curus risus viverra sed.</p>
					<h5 class="pt-4">Our history</h5>
					<p>Led at felis arcu. Integer lorem lorem, tincidunt eu congue et, mattis ut ante. Nami suscipit, lectus id efficitur ornare, leo libero convalis nulla, vitae dignissim .</p>
					<ul class="about-list">
						<li><i class="fa fa-check-square-o"></i> University Faculties organise teaching and research into individual subjects.</li>
						<li><i class="fa fa-check-square-o"></i> The University is rich in history - its famous buildings attract visitors.</li>
						<li><i class="fa fa-check-square-o"></i> 50 years of people, and achievements that continue to transform.</li>
						<li><i class="fa fa-check-square-o"></i> The University's core values are as follows:freedom of thought.</li>
					</ul>
				</div>
				<div class="col-lg-6 pt-5 pt-lg-0">
					<img src="{{asset('assets_frontend/img/about.jpg')}}" alt="">
				</div>
			</div>
		</div>
	</section>
	<!-- About section end-->

 

@endsection

