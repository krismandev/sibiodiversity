@extends("layouts.frontend.master")
@section("title","Explore")
@section("content")
<div class="row">
    <div class="col-3">
        <section id="nav-abjad" class="nav-abjad section-bg ">
            <div class="container">  
                <span class="mt-2" style=" font-size: 18px; font-weight: bold; color: #37517e;">Cari Data Ikan :</span>  
                <form>
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="Kata Kunci ...">
                        <button class="btn btn-sm btn-outline-dark" type="button">Cari</button>
                    </div>
                </form>
            </div>
           

        </section>
        <section id="nav-type" class="nav-type section-bg">
            <div class="container">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Endemik
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        Non Endemik
                    </label>
                </div>
                <button type="submit" class="btn btn-sm btn-outline-dark">Cari</button>
            </div>
        </section>
    </div>
    <div class="col-9">
        <!-- ======= Cliens Section ======= -->
        <!-- <section id="nav-abjad" class="nav-abjad section-bg fixed-bottom">
            <div class="container">
            <span class="mt-2" style=" font-size: 18px; font-weight: bold; color: #37517e;">Berdasarkan Abjad: </span> 
                <ol class="mb-2">
                <li><a href="#"> All </a></li>
                    @foreach(range('A','Z') as $abjad)
                        <li><a href="#"> {{ $abjad }} </a></li>
                    @endforeach
                </ol>
            </div>
        </section> -->

        <section id="nav-abjad" class="nav-abjad section-bg">
            <div class="container">
            <span class="mt-2" style=" font-size: 18px; font-weight: bold; color: #37517e;">Berdasarkan Abjad: </span> 
          
                <ol class="mb-2">
                <li><a href="#"> All </a></li>
                    @foreach(range('A','Z') as $abjad)
                        <li><a href="#"> {{ $abjad }} </a></li>
                    @endforeach
                </ol>
            

            </div>
        </section>
        <!-- ======= Ikan Section ======= -->
        <section id="ikan" class="ikan ">
            <div class="container " data-aos="fade-up">
                <div class="section-title">
                    
                    <p class="badge bg-info">Total Data Ikan : </p>  

                    <h2 class="mt-2">{{$data_spesies->count()}}</h2> 
                </div>

                <div class="row">
                    @forelse($data_spesies as $item)
                    <div class="col-lg-4 mt-2 ">
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">    
                            <div class="card border-0">
                                <img class="card-img-top" src="{{$item->getImage()}}" style="width:400px"  alt="{{$item->getImage()}}">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: 700; margin-bottom: 5px; font-size: 20px; color: #37517e;">{{ $item->nama_umum }}</h5>
                                    <p class="card-text" style="display: block; font-size: 15px;padding-bottom: 10px; position: relative; font-weight: 500;">( <em> {{ $item->nama_latin }} </em> )</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p><center> Data Tidak Ditemukan </center> </p>
                    @endforelse

                </div>
            </div>
        </section><!-- End Ikan Section -->
    </div>
</div>
@endsection