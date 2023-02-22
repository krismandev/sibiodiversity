@extends("layouts.frontend.master")
@section("title","Detail Spesies")
@section("content")
<!-- Breadcrumb section -->
<div class="site-breadcrumb">
	<div class="container">
		<a href="{{route('home.frontend')}}"><i class="fa fa-home"></i> Beranda</a> <i class="fa fa-angle-right"></i>
		<a href="{{route('explorer.frontend')}}"> Explorer</a> <i class="fa fa-angle-right"></i>
		<span>Detail Explorer</span>
	</div>
</div>
<!-- Breadcrumb section end -->
<section class="blog-page-section spad pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped">
                <thead>
                    <h3>Data Informasi {!! $data->nama_umum ?? '' !!} </h3>
                    <h5> {!! $data->nama_latin ?? '' !!} </h5>
                    <tr>
                        <th colspan="3"><center><img src="{{$data->getImage()}}"></center></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td colspan="3"><b>Deskripsi :</b> <p>{!! $data->deskripsi !!}</p></td>

                    </tr>
                    <tr>
                        <td scope="col">Nama Umum</td>
                        <td>:</td>
                        <td scope="col">{!! $data->nama_umum !!}</td>
                    </tr>
                    <tr>
                        <td scope="col">Nama Latin</td>
                        <td scope="col">:</td>
                        <td scope="col"><em>{!! $data->nama_latin !!}</em></td>
                    </tr>
                    <tr>
                        <td scope="col">Class</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->genus->famili->ordo->class->nama_umum}}</td>
                    </tr>

                    <tr>
                        <td scope="col">Ordo</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->genus->famili->ordo->nama_umum}}</td>
                    </tr>

                    <tr>
                        <td scope="col">Famili</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->genus->famili->nama_umum}}</td>
                    </tr>

                    <tr>
                        <td scope="col">Genus</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->genus->nama_umum}}</td>
                    </tr>


                    <tr>
                        <td scope="col">Meristik</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->meristik}}</td>
                    </tr>
                    <tr>
                        <td scope="col">Status Konservasi</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->status_konservasi->status_konservasi}}</td>
                    </tr>
                    <tr>
                        <td scope="col">Potensi</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->potensi}}</td>
                    </tr>
                    <tr>
                        <td scope="col">Keaslian Jenis</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->keaslian_jenis}}</td>
                    </tr>
                    <tr>
                        <td scope="col">Distribusi Global</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->distribusi_global}}</td>
                    </tr>
                    <tr>
                        <td scope="col">Kode Spesimen</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->detail_spesimen->kd_spesimen}}</td>
                    </tr>
                    <tr>
                        <td scope="col">Kolektor</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->detail_spesimen->kolektor}}</td>
                    </tr>
                    <tr>
                        <td scope="col">Tanggal Penemuan</td>
                        <td scope="col">:</td>
                        <td scope="col">@if($data->detail_spesimen->tanggal_penemuan) {{date("d-m-Y",strtotime($data->detail_spesimen->tanggal_penemuan)) ?? ''}} @else - @endif </td>
                    </tr>
                    <tr>
                        <td scope="col">Lokasi Penemuan</td>
                        <td scope="col">:</td>
                        <td scope="col">
                            {{$data->detail_spesimen->lokasi_penemuan->nama_lokasi ?? ''}}, Kec. {{$data->detail_spesimen->lokasi_penemuan->kecamatan->nama_kecamatan ?? '-'}}, Kab. {{$data->detail_spesimen->lokasi_penemuan->kabupaten->nama_kabupaten ?? '-'}}, {{$data->detail_spesimen->lokasi_penemuan->provinsi->nama_provinsi ?? '-'}}
                        </td>
                    </tr>
                    <tr>
                        <td scope="col">Lokasi Penyimpanan</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->detail_spesimen->lokasi_penyimpanan}}</td>
                    </tr>
                    <tr>
                        <td scope="col">Rantai DNA</td>
                        <td scope="col">:</td>
                        <td scope="col">
                            @if ($data->detail_spesimen->rantai_dna != null)
                                <a href="{{asset('storage/rantai_dna/'.$data->detail_spesimen->rantai_dna)}}">Download</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td scope="col">Kondisi Air</td>
                        <td scope="col">:</td>
                        <td scope="col"> <p>{!! $data->kondisi_air !!}</p></td>

                    </tr>
                    <tr>
                        <td scope="col">Etnosains</td>
                        <td scope="col">:</td>
                        <td scope="col"> <p>{!! $data->etnosains !!}</p></td>

                    </tr>
                </tbody>
                </table>

                <div class="navigation-area">
                  <div class="row">
                      @if (isset($previous))
                      <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                          <div class="detials">
                              <p>Prev Spesies</p>
                              <a href="{{url('/explorer-detail/'.$data->previous()->id)}}"><h4>{{$data->previous()->nama_umum}}</h4></a>
                          </div>
                      </div>
                      @else
                      <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                          <div class="detials">
                              <p>Prev Spesies</p>
                              <a href="#"><h4>-</h4></a>
                          </div>
                      </div>
                      @endif
                      @if (isset($next))
                      <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                          <div class="detials">
                              <p>Next Spesies</p>
                              <a href="{{url('/explorer-detail/'.$data->next()->id)}}"><h4>{{$data->next()->nama_umum}}</h4></a>
                          </div>
                      </div>
                      @else
                      <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                          <div class="detials">
                              <p>Next Spesies</p>
                              <a href="#"><h4>-</h4></a>
                          </div>
                      </div>
                      @endif
                  </div>
                </div>


            </div>
            <!-- sidebar -->
            <div class="col-sm-8 col-md-5 col-lg-4 col-xl-3 offset-xl-1 offset-0 pl-xl-0 sidebar">
                <!-- widget -->
                <div class="widget">
                    <form class="search-widget">
                        <input type="text" placeholder="Search...">
                        <button><i class="ti-search"></i></button>
                    </form>
                </div>
                <!-- widget -->
                <div class="widget">
                    <h5 class="widget-title">Recent Spesies</h5>
                    <div class="recent-post-widget">
                        <!-- recent spesies -->
                        @forelse($data_spesies as $data_terbaru)
                        <div class="rp-item">
                            <div class="rp-thumb set-bg" data-setbg="#"><img src="{{$data_terbaru->getImage()}}"></div>
                            <div class="rp-content">
                                <h6>{!! $data_terbaru->nama_umum !!}</h6>
                                <p><i class="fa fa-clock-o"></i> {{$data_terbaru->created_at}}</p>
                            </div>
                        </div>
                        @empty
                        <p>Belum ada data</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog page section end -->
@endsection
