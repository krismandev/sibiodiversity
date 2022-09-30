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
            @forelse($gallery as $item)
            <div class="col-lg-4 col-md-6 course-item">
                <div class="course-thumb">
                    @if($item->jenis_file == "Gambar")
                    <a href="{{$item->getGallery()}}">
                        <img  src="{{$item->getGallery()}}" alt="{{asset('assets_frontend/img/course/1.jpg')}}" alt="">
                    </a>
                    @else
                    <video controls>
                      <source src="{{$item->getGallery()}}" type="video" alt="{{asset('assets_frontend/img/course/1.jpg')}}"/>
                    </video>
                    @endif

                </div>
            </div>
            @empty
            <h5> Belum Memiliki Gallery</h5>
            @endforelse
        </div>
        <div class="text-center">
           {{ $gallery->links() }}
        </div>
    </div>
</section>
<!-- Courses section end-->
@endsection