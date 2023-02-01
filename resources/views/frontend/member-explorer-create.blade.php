@extends("layouts.frontend.master")
@if(isset($spesies))
@section("title","Update Spesies ")
@else
@section("title","Tambah Spesies Baru")
@endif

@section("content")


<!-- Breadcrumb section -->
<div class="site-breadcrumb">
    <div class="container">
        <a href="#"><i class="fa fa-home"></i> Beranda</a> <i class="fa fa-angle-right"></i>
        @if(isset($spesies))
        <span>Update Data Spesies</span>
        @else
        <span>Tambah Spesies Baru</span>
        @endif
    </div>
</div>
<!-- Breadcrumb section end -->
<!-- Courses section -->
<section class="full-courses-section spad pt-0">
    <div class="container">
    <div class="col-12">
      <div class="card">
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <div class="card-header">
          <h5>Data Spesies</h5>
        </div>
        <div class="card-body p-0">
            <form role="form" action="{{isset($spesies) ? route('member-explorer.update') : route('member-explorer.store')}}" method="post" enctype="multipart/form-data">
                @if(isset($spesies))
                  @csrf
                  @method("PATCH")
                  <input type="hidden" name="spesies_id" value="{{encrypt($spesies->id)}}">
                  <input type="hidden" name="detail_spesimen_id" value="{{$spesies->detail_spesimen->id}}">
                @else
                  @csrf
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLatin">Pilih Genus</label>
                    <select class="form-control" name="genus_id">
                      <option value="" selected>Pilih Genus</option>
                      @if(isset($spesies))
                      <option value="{{$spesies->genus_id}}" selected>{{$spesies->genus->nama_latin}}</option>
                      @endif
                      @foreach ($genuses as $genus)
                      <option value="{{$genus->id}}">{{$genus->nama_latin}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Latin</label>
                    <textarea name="nama_latin" cols="30" rows="5" class="form-control ckeditor">{{$spesies->nama_latin ?? ''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Umum</label>
                    <textarea name="nama_umum" cols="30" rows="5" class="form-control ckeditor">{{$spesies->nama_umum ?? ''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Meristik</label>
                    <input type="text" class="form-control" placeholder="" name="meristik" value="{{$spesies->meristik ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Status Konservasi</label>
                    <select class="form-control" name="status_konservasi_id">
                      <option>Pilih Status Konservasi</option>
                      @if(isset($spesies))
                      <option value="{{$spesies->status_konservasi_id}}" selected>{{$spesies->status_konservasi->status_konservasi}}</option>
                      @endif
                      @foreach ($status_konservasis as $status)
                      <option value="{{$status->id}}">{{$status->status_konservasi}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Potensi</label>
                    <input type="text" class="form-control" placeholder="" name="potensi" value="{{$spesies->potensi ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Keaslian Jenis</label>
                    <input type="text" class="form-control" placeholder="" name="keaslian_jenis" value="{{$spesies->keaslian_jenis ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Distribusi Global</label>
                    <input type="text" class="form-control" placeholder="" name="distribusi_global" value="{{$spesies->distribusi_global ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                      <select class="form-control" name="status" id="status" value="{{$spesies->status ?? ''}}" >
                        <option value="{{$spesies->status ?? ''}}" selected>---Pilih Status---</option>
                        @if(isset($spesies))
                        <option value="valid"  {{ $spesies->status == "valid" ? 'selected' : '' }}>Valid</option>
                        <option value="verified"  {{ $spesies->status == "verified" ? 'selected' : '' }}>Verified</option>
                        <option value="checking"  {{ $spesies->status == "checking" ? 'selected' : '' }}>Checking</option>
                        @else
                        <option value="valid"  >Valid</option>
                        <option value="verified"  >Verified</option>
                        <option value="checking"  >Checking</option>
                        @endif                      
                      </select>  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Gambar</label>
                    {{-- <div class="input-group"> --}}
                      {{-- <div class="custom-file"> --}}
                        <input type="file" class="form-control" id="exampleInputFile" name="gambar">
                        {{-- <label class="custom-file-label" for="exampleInputFile">Pilih File</label> --}}
                        @if (isset($spesies) && $spesies->gambar != null)
                          <small>Abaikan jika tidak ingin mengubah gambar</small>                            
                        @endif
                      {{-- </div> --}}
                    {{-- </div> --}}
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Deskripsi</label>
                    <textarea name="deskripsi" cols="30" rows="5" class="form-control ckeditor">{{$spesies->deskripsi ?? ''}}</textarea>
                  </div>
                </div>
                <div class="card-header">
                <h5>Detail Spesimen</h5>
                </div>
                <!-- /.card-body -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="lokasi_penemuan">Kode Spesimen</label>
                    <input type="text" class="form-control" placeholder="" name="kd_spesimen" value="{{$spesies->detail_spesimen->kd_spesimen ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="lokasi_penemuan">Lokasi Penemuan</label>
                    <input type="text" class="form-control" placeholder="" name="nama_lokasi" value="{{$spesies->detail_spesimen->lokasi_penemuan->nama_lokasi ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">*Abaikan jika tidak ingin mengubah data lokasi, jika anda mengubah lokasi harap pilih kabupaten dan kecamatan</label><br/> 
                    <label for="namaLatin">Provinsi Penemuan
                    @if(isset($spesies) && $spesies->detail_spesimen->lokasi_penemuan->provinsi_id != Null)
                           : {{$spesies->detail_spesimen->lokasi_penemuan->provinsi->nama_provinsi}}
                        @endif
                    </label>
                    <select class="form-control" name="provinsi_id" id="provinsi" value="{{$spesies->detail_spesimen->lokasi_penemuan->provinsi_id  ?? ''}}" >
                    <option value="{{$spesies->detail_spesimen->lokasi_penemuan->provinsi_id  ?? ''}}" disable selected>---Pilih Provinsi---</option>
                        
                            @foreach($provinsi as $data_provinsi)
                            <option value="{{$data_provinsi->id}}">{{$data_provinsi->nama_provinsi}}</option>
                            @endforeach
                            
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kabupaten Penemuan 
                        @if(isset($spesies) && $spesies->detail_spesimen->lokasi_penemuan->kabupaten_id != Null)
                           : {{$spesies->detail_spesimen->lokasi_penemuan->kabupaten->nama_kabupaten}}
                        @endif
                    </label>
                      <select class="form-control" name="kabupaten_id" id="kabupaten" value="{{$spesies->detail_spesimen->lokasi_penemuan->kabupaten_id  ?? ''}}">
                      <option value="{{$spesies->detail_spesimen->lokasi_penemuan->kabupaten_id  ?? ''}}" selected>---Pilih Kabupaten---</option>
                      </select>  
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kecamatan Penemuan :
                        @if(isset($spesies) && $spesies->detail_spesimen->lokasi_penemuan->kecamatan_id != Null)
                           : {{$spesies->detail_spesimen->lokasi_penemuan->kecamatan->nama_kecamatan}}
                        @endif
                    </label>
                      <select class="form-control" name="kecamatan_id" id="kecamatan" value="{{$spesies->detail_spesimen->lokasi_penemuan->kecamatan_id  ?? ''}}">
                        <option value="{{$spesies->detail_spesimen->lokasi_penemuan->kecamatan_id  ?? ''}}" selected>---Pilih Kecamatan---</option>
                      </select> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Tanggal Penemuan</label>
                    <input type="date" class="form-control" name="tanggal_penemuan" value="{{$spesies->detail_spesimen->tanggal_penemuan ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kolektor</label>
                    <input type="text" class="form-control" name="kolektor" value="{{$spesies->detail_spesimen->kolektor ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Rantai DNA</label>
                     <div class="input-group"> 
                       <div class="custom-file"> 
                        <input type="file" class="form-control" id="exampleInputFile" name="rantai_dna">
                         <label class="custom-file-label" for="exampleInputFile">Pilih File</label> 
                        @if (isset($spesies) && $spesies->detail_spesimen->rantai_dna != null)
                          <small>Abaikan jika tidak ingin mengubah file rantai dna</small>                            
                        @endif
                       </div> 
                     </div> 
                  </div>
                  <div class="form-group">
                    <label for="lokasi_penemuan">Lokasi Penyimpanan</label>
                    <input type="text" class="form-control" placeholder="" name="lokasi_penyimpanan" value="{{$spesies->detail_spesimen->lokasi_penyimpanan ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="lokasi_penemuan">Rujukan</label>
                    <input type="text" class="form-control" placeholder="" name="rujukan" value="{{$spesies->rujukan ?? ''}}">
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    </div>
    
</section>
<!-- Courses section end-->
@endsection
@section("linkfooter")
@include('frontend.js.wilayah-js')
{{-- <script src="{{asset('js/wilayah.js')}}"></script> --}}
<script src="{{asset('asset_dashboard/plugins/ckeditor/ckeditor.js')}}"></script>
@endsection