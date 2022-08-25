@extends("layouts.frontend.master")
@section("title","Gallery")
@section("content")
<!-- Breadcrumb section -->
<div class="site-breadcrumb">
    <div class="container">
        <a href="#"><i class="fa fa-home"></i> Beranda</a> <i class="fa fa-angle-right"></i>
        <span>Gallery</span>
    </div>
</div>
<!-- Breadcrumb section end -->
<!-- Courses section -->
<section class="full-courses-section spad pt-0">
    <div class="container">
        <div class="row">
            <!-- course item -->
            <div class="col-lg-4 col-md-6 course-item">
                <div class="course-thumb">
                    <img src="{{asset('assets_frontend/img/course/1.jpg')}}" alt="">
                    <div class="course-cat">
                        <span>VIDIO</span>
                    </div>
                </div>
                <div class="course-info">
                    <h4>Certificate Course in Writing<br>for a Global Market</h4>
                </div>
            </div>
            <!-- course item -->
            <div class="col-lg-4 col-md-6 course-item">
                <div class="course-thumb">
                    <img src="{{asset('assets_frontend/img/course/2.jpg')}}" alt="">
                    <div class="course-cat">
                        <span>FOTO</span>
                    </div>
                </div>
                <div class="course-info">
                    <h4>Google AdWords: Get More<br> Customers with Search Marketing </h4>
                </div>
            </div>
            <!-- course item -->
            <div class="col-lg-4 col-md-6 course-item">
                <div class="course-thumb">
                    <img src="{{asset('assets_frontend/img/course/3.jpg')}}" alt="">
                    <div class="course-cat">
                        <span>FOTO</span>
                    </div>
                </div>
                <div class="course-info">
                    <h4>The Ultimate Drawing Course<br> Beginner to Advanced</h4>
                </div>
            </div>
            <!-- course item -->
            <div class="col-lg-4 col-md-6 course-item">
                <div class="course-thumb">
                    <img src="{{asset('assets_frontend/img/course/4.jpg')}}" alt="">
                    <div class="course-cat">
                        <span>VIDIO</span>
                    </div>
                </div>
                <div class="course-info">
                    <h4>Ultimate MySQL Bootcamp: Go from SQL Beginner to Expert</h4>
                </div>
            </div>
            <!-- course item -->
            <div class="col-lg-4 col-md-6 course-item">
                <div class="course-thumb">
                    <img src="{{asset('assets_frontend/img/course/5.jpg')}}" alt="">
                    <div class="course-cat">
                        <span>VIDIO</span>
                    </div>
                </div>
                <div class="course-info">
                    <h4>Web Developer Bootcamp<br>Make web  applications</h4>
                    
                </div>
            </div>
            <!-- course item -->
            <div class="col-lg-4 col-md-6 course-item">
                <div class="course-thumb">
                    <img src="{{asset('assets_frontend/img/course/6.jpg')}}" alt="">
                    <div class="course-cat">
                        <span>FOTO</span>
                    </div>
                </div>
                <div class="course-info">
                    <h4>How to Start an Amazon<br>FBA Store on a Tight Budget</h4>
                </div>
            </div>
        </div>
        <div class="text-center">
            <ul class="site-pageination">
                <li><a href="#" class="active">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
            </ul>
        </div>
    </div>
</section>
<!-- Courses section end-->
@endsection