@extends("layouts.frontend.master")
@section("title","Detail Spesies")
@section("content")
<?php
$existincookie = $hasCookie ?? false;
?>
<!-- Breadcrumb section -->
<div class="site-breadcrumb">
	<div class="container">
		<a href="{{route('home.frontend')}}"><i class="fa fa-home"></i> {{GoogleTranslate::trans('Beranda', app()->getLocale())}}</a> <i class="fa fa-angle-right"></i>
		<a href="{{route('explorer.frontend')}}"> Explorer</a> <i class="fa fa-angle-right"></i>
		<span>{{GoogleTranslate::trans('Detail Explorer', app()->getLocale())}}</span>
	</div>
</div>
<!-- Breadcrumb section end -->
<section class="blog-page-section spad pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped">
                <thead>
                    <h3>{{GoogleTranslate::trans('Data Informasi', app()->getLocale())}} {!! GoogleTranslate::trans($data->nama_umum ?? '-', app()->getLocale()) !!} </h3>
                    <h5> {!! GoogleTranslate::trans($data->nama_latin ?? '', app()->getLocale())  !!} </h5>
                    <tr>
                        <th colspan="3"><center><img src="{{$data->getImage()}}"></center></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td colspan="3"><b>{{GoogleTranslate::trans('Deskripsi :', app()->getLocale())}} </b> <p>{!! GoogleTranslate::trans($data->deskripsi ?? '-', app()->getLocale()) !!}</p></td>

                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Nama Umum', app()->getLocale())}} </td>
                        <td>:</td>
                        <td scope="col">{!! $data->nama_umum !!}</td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Nama Latin', app()->getLocale())}} </td>
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
                        <td scope="col">{{GoogleTranslate::trans('Meristik', app()->getLocale())}} </td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->meristik ?? '-'}}</td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Status Konservasi', app()->getLocale())}}</td>
                        <td scope="col">:</td>
                        <td scope="col">{{GoogleTranslate::trans($data->status_konservasi->status_konservasi ?? '-', app()->getLocale()) }}</td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Potensi', app()->getLocale())}} i</td>
                        <td scope="col">:</td>
                        <td scope="col">{{GoogleTranslate::trans($data->potensi ?? '-', app()->getLocale()) }}</td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Keaslian Jenis', app()->getLocale())}} </td>
                        <td scope="col">:</td>
                        <td scope="col">{{GoogleTranslate::trans($data->keaslian_jenis ?? '-', app()->getLocale()) }}</td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Distribusi Global', app()->getLocale())}} </td>
                        <td scope="col">:</td>
                        <td scope="col">{{GoogleTranslate::trans($data->distribusi_global ?? '-', app()->getLocale()) }}</td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans(' Kode Spesimen', app()->getLocale())}}</td>
                        <td scope="col">:</td>
                        <td scope="col">{{$data->detail_spesimen->kd_spesimen}}</td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Kolektor', app()->getLocale())}} </td>
                        <td scope="col">:</td>
                        <td scope="col">{{GoogleTranslate::trans($data->detail_spesimen->kolektor ?? '-', app()->getLocale()) }}</td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Tanggal Penemuan', app()->getLocale())}} </td>
                        <td scope="col">:</td>
                        <td scope="col">@if($data->detail_spesimen->tanggal_penemuan) {{date("d-m-Y",strtotime($data->detail_spesimen->tanggal_penemuan)) ?? ''}} @else - @endif </td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Lokasi Penemuan', app()->getLocale())}}</td>
                        <td scope="col">:</td>
                        <td scope="col">
                            {{ GoogleTranslate::trans($data->detail_spesimen->lokasi_penemuan->nama_lokasi ?? '-', app()->getLocale()) }}, Kec. {{ GoogleTranslate::trans($data->detail_spesimen->lokasi_penemuan->kecamatan->nama_kecamatan ?? '-', app()->getLocale()) }}, Kab. {{ GoogleTranslate::trans($data->detail_spesimen->lokasi_penemuan->kabupaten->nama_kabupaten ?? '-', app()->getLocale()) }}, {{GoogleTranslate::trans($data->detail_spesimen->lokasi_penemuan->provinsi->nama_provinsi ?? '-', app()->getLocale()) }}
                        </td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Lokasi Penyimpanan', app()->getLocale())}} </td>
                        <td scope="col">:</td>
                        <td scope="col">{{ GoogleTranslate::trans($data->detail_spesimen->lokasi_penyimpanan ?? '-', app()->getLocale()) }}</td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Rantai DNA', app()->getLocale())}} </td>
                        <td scope="col">:</td>
                        {{-- <td scope="col">
                            @if ($data->detail_spesimen->rantai_dna != null)
                                <a href="{{asset('storage/rantai_dna/'.$data->detail_spesimen->rantai_dna)}}">Download</a>
                            @endif
                        </td> --}}
                        <td scope="col">
                            Hubungi <a href="https://wa.me/6282174219502" target="__blank">Tedjo Sukmono</a>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Kondisi Air', app()->getLocale())}} </td>
                        <td scope="col">:</td>
                        <td scope="col"> <p>{!! GoogleTranslate::trans($data->kondisi_air ?? '-', app()->getLocale())  !!}</p></td>

                    </tr>
                    <tr>
                        <td scope="col">{{GoogleTranslate::trans('Etnosains', app()->getLocale())}} </td>
                        <td scope="col">:</td>
                        <td scope="col"> <p>{!! GoogleTranslate::trans($data->etnosains ?? '-', app()->getLocale()) !!}</p></td>

                    </tr>
                </tbody>
                </table>
                <div class="mt-5 mb-5">
                    <i>Sukmono,T., Kaswari, T, Utomo, PEP, Wulandari, T. <a href="http://ikanjambi.unja.ac.id.Universitas Jambi.2023"> ikanjambi.unja.ac.id.Universitas Jambi.2023 </a> </i>
                </div>

                <div class="row">
                    {{-- <div class="col-lg-12"> --}}
                        @foreach ($data->list_gambar as $nama_gambar)
                            <div class="col-lg-2 col-sm-4 col-md-4" style="max-height: 200px;">
                                <img src="{{asset('storage/spesies/'.$nama_gambar)}}" style="object-fit: cover; object-position: center;">
                            </div>
                        @endforeach
                    {{-- </div> --}}
                </div>

                <div class="navigation-area mt-4">
                  <div class="row">
                      @if (isset($previous))
                      <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                          <div class="detials">
                              <p>Prev Spesies</p>
                              <a href="{{url('/explorer-detail/'.$data->previous()->id)}}"><h4>{!! $data->previous()->nama_umum !!}</h4></a>
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
                              <a href="{{url('/explorer-detail/'.$data->next()->id)}}"><h4>{!! $data->next()->nama_umum !!}</h4></a>
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
                                <h6>{!! GoogleTranslate::trans($data_terbaru->nama_umum, app()->getLocale())  !!}</h6>
                                <p><i class="fa fa-clock-o"></i> {{$data_terbaru->created_at}}</p>
                            </div>
                        </div>
                        @empty
                        <p>{{GoogleTranslate::trans('Belum ada data', app()->getLocale())}}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog page section end -->
@endsection
