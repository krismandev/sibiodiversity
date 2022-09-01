@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Spesies</li>
@endsection
@section("title","Spesies")
@section("content")
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5>Data Spesies</h5>
        </div>
        <div class="card-body p-0">

                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLatin">Genus</label>
                    <input type="text" class="form-control"  value="{{$spesies->genus->nama_latin}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Latin</label>
                    <input type="text" class="form-control"  value="{{$spesies->nama_latin}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Umum</label>
                    <input type="text" class="form-control" value="{{$spesies->nama_umum}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Meristik</label>
                    <input type="text" class="form-control"  value="{{$spesies->meristik}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Status Konservasi</label>
                    <input type="text" class="form-control"  value="{{$spesies->status_konservasi->status_konservasi}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Potensi</label>
                    <input type="text" class="form-control" value="{{$spesies->potensi}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Keaslian Jenis</label>
                    <input type="text" class="form-control"  value="{{$spesies->keaslian_jenis}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Distribusi Global</label>
                    <input type="text" class="form-control" value="{{$spesies->distribusi_global}}"> 
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" value="{{$spesies->status}}"> 
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Gambar</label>
                    <img src="{{$spesies->getImage()}}">
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Deskripsi</label>
                    <textarea name="deskripsi" cols="30" rows="5" class="form-control ckeditor">{{$spesies->deskripsi}}</textarea>
                  </div>
                </div>
                <div class="card-header">
                <h5>Detail Spesimen</h5>
                </div>
                <!-- /.card-body -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="lokasi_penemuan">Kode Spesimen</label>
                    <input type="text" class="form-control" value="{{$spesies->detail_spesimen->kd_spesimen}}">
                  </div>
                  <div class="form-group">
                    <label for="lokasi_penemuan">Lokasi Penemuan</label>
                    <input type="text" class="form-control" value="{{$spesies->detail_spesimen->lokasi_penemuan->nama_lokasi}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Provinsi Penemuan</label>
                    <input type="text" class="form-control" value="{{$spesies->detail_spesimen->lokasi_penemuan->provinsi->nama_provinsi}}">

                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kabupaten Penemuan</label>
                    <input type="text" class="form-control" value="{{$spesies->detail_spesimen->lokasi_penemuan->kabupaten->nama_kabupaten}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kecamatan Penemuan</label>
                    <input type="text" class="form-control" value="{{$spesies->detail_spesimen->lokasi_penemuan->kecamatan->nama_kecamatan}}">

                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Tanggal Penemuan</label>
                    <input type="date" class="form-control" name="tanggal_penemuan" value="{{$spesies->detail_spesimen->tanggal_penemuan}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kolektor</label>
                    <input type="text" class="form-control" name="kolektor" value="{{$spesies->detail_spesimen->kolektor}}"> 
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Rantai DNA</label>
                    @if($spesies->rantai_dna != Null)
                    <a href="{{$spesies->detail_spesimen->rantai_dna}}"> Lihat</a>
                    @else
                    <br/> Data Tidak Ada

                    @endif
                    
                  </div>
                  <div class="form-group">
                    <label for="lokasi_penemuan">Lokasi Penyimpanan</label>
                    <input type="text" class="form-control" value="{{$spesies->detail_spesimen->lokasi_penyimpanan }}">
                  </div>
                  <div class="form-group">
                    <label for="lokasi_penemuan">Rujukan</label>
                    <input type="text" class="form-control"  value="{{$spesies->detail_spesimen->rujukan}}">
                  </div>
        
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

@endsection
@section("linkfooter")
@include('dashboard.master.spesies.js.wilayah-js')
<script src="{{asset('asset_dashboard/plugins/ckeditor/ckeditor.js')}}"></script>

@endsection
