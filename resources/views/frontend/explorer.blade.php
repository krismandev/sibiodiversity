@extends("layouts.frontend.master")
@section("title","Explorer")
@section("content")
<!-- Breadcrumb section -->
<div class="site-breadcrumb">
	<div class="container">
		<a href="{{route('home.frontend')}}"><i class="fa fa-home"></i> Beranda</a> <i class="fa fa-angle-right"></i>
		<span>Explorer</span>
	</div>
</div>
{{-- <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
</div> --}}
<!-- Breadcrumb section end -->
<section class="explorer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <span class="mt-2" style=" font-size: 18px; font-weight: bold; color: #37517e;">Cari Data Ikan :</span>
                <form>
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="Kata Kunci ..." name="search">
                        <button class="btn btn-sm btn-outline-dark btn-search" type="button">Cari</button>
                    </div>
                </form>
            </div>
            <div class="col-md-9 col-lg-9" id="nav-abjad">
            <span class="mt-2" style=" font-size: 18px; font-weight: bold; color: #37517e;">Berdasarkan Abjad: </span>
                <ol class="mb-2">
                    <li><a href="#" data-abjad="all" class="abjad"> All </a></li>
                    @foreach(range('A','Z') as $abjad)
                        <li><a href="#" data-abjad="{{$abjad}}" class="abjad"> {{ $abjad }} </a></li>
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
            <p>Total {{$count_spesies}} data</p>
        </div>
        <div class="row" id="list-ikan-holder">
            @forelse($data_spesies as $item)

            <div class="col-xl-4">

                <div class="blog-item">

                    <div class="card" style="width: 18rem;" >
                    <img src="{{$item->getImage()}}" class="card-img-top" alt="{{$item->getImage()}}">
                    <div class="card-body">
                        <h5 class="card-title">{!! $item->nama_umum !!}</h5>
                        <p class="card-text">{!! $item->nama_latin !!}  </p>
                        @php
                            $trancated = Str::of($item->deskripsi)->limit(200);
                        @endphp
                        <p>
                            {!!$trancated!!}
                        </p>
                        <a href="{{url('/explorer-detail/'.$item->id)}}" style="align:text-right" class="btn btn-primary">Detail</a>
                    </div>
                    </div>
                </div>

            </div>
            @empty

            <p><center> Data Tidak Ditemukan </center> </p>
            @endforelse
            <div>
                <center>{{$data_spesies->links()}}</center>
            </div>
        </div>
    </div>
</section>
@endsection
@section("linkfooter")
<script>
    $(document).ready(function () {
        $(".abjad").click(function (e) {
            e.preventDefault();
            let abjad = $(this).data("abjad");
            url = "/explorer?abjad="+abjad
            // let param = {
            //     abjad: abjad
            // }
            // doAjax(param)
            window.location.href = url

        });
        // $(".abjad").click(function (e) {
        //     e.preventDefault();
        //     let abjad = $(this).data("abjad");
        //     let param = {
        //         abjad: abjad
        //     }
        //     doAjax(param)

        // });

        $(".btn-search").click(function (e) {
            e.preventDefault();
            let keyword = $("input[name='search']").val();
            url = "/explorer?search="+keyword
            // let param = {
            //     abjad: abjad
            // }
            // doAjax(param)
            window.location.href = url
        });
        // $(".btn-search").click(function (e) {
        //     e.preventDefault();
        //     let keyword = $("input[name='search']").val();
        //     let param = {
        //         search: keyword
        //     }
        //     doAjax(param)
        // });
    });

    function doAjax(obj) {
        $.ajax({
            url : '/explorer/filter',
            type : 'GET',
            dataType : 'html',
            data : obj,
            success : function(resp){
                $("#list-ikan-holder").empty();
                $("#list-ikan-holder").html(resp);
            },
            error : function(resp){
            }
        });
    }
</script>
@endsection
