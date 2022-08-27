@extends("layouts.frontend.master")
@section("title","Explore")
@section("content")
<!-- Breadcrumb section -->
<div class="site-breadcrumb">
	<div class="container">
		<a href="{{route('home.frontend')}}"><i class="fa fa-home"></i> Beranda</a> <i class="fa fa-angle-right"></i>
		<span>Explorer</span>
	</div>
</div>
<!-- Breadcrumb section end -->
<section class="explorer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <span class="mt-2" style=" font-size: 18px; font-weight: bold; color: #37517e;">Cari Data Ikan :</span>  
                <form>
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="Kata Kunci ...">
                        <button class="btn btn-sm btn-outline-dark" type="button">Cari</button>
                    </div>
                </form>
            </div>
            <div class="col-md-9 col-lg-9" id="nav-abjad">
            <span class="mt-2" style=" font-size: 18px; font-weight: bold; color: #37517e;">Berdasarkan Abjad: </span> 
                <ol class="mb-2">
                <li><a href="#"> All </a></li>
                    @foreach(range('A','Z') as $abjad)
                        <li><a href="#"> {{ $abjad }} </a></li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="blog-section spad">
    <div class="container">
        <div class="section-title text-center">
            <h3>DATA IKAN</h3>
            <p>Total {{$data_spesies->count()}} data</p>
        </div>
        <div class="row">
            @forelse($data_spesies as $item)
          
            <div class="col-xl-6">
            <a href="{{url('/explorer-detail/'.$item->id)}}">
                <div class="blog-item">
                    <div class="blog-thumb set-bg" data-setbg="{{$item->getImage()}}"></div>
                    <div class="blog-content">
                        <h4>{{ $item->nama_umum }}</h4>
                        <span>( <em> {{ $item->nama_latin }} </em> )</span>
                        <div class="blog-meta">
                            <span><i class="fa fa-calendar-o"></i> ( <em> {{ $item->created_at }} </em> )</span>
                            <span><i class="fa fa-user"></i> {{$item->user_id}}</span>
                        </div>
                        <!-- <p>Integer luctus diam ac scerisque consectetur. Vimus dot euismod neganeco lacus sit amet. Aenean interdus mid vitae sed accumsan...</p> -->
                    </div>
                </div>
            </a>
            </div>
            @empty
            <p><center> Data Tidak Ditemukan </center> </p>
            @endforelse
        </div>
    </div>
</section>
@endsection
