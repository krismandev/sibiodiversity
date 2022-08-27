@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route("home.dashboard")}}">Home</a></li>
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
            <form role="form" action="{{isset($spesies) ? route('spesies.update') : route('spesies.store')}}" method="post" enctype="multipart/form-data">
                @if(isset($spesies))
                  @csrf
                  @method("PATCH")
                  <input type="hidden" name="spesies_id" value="{{encrypt($spesies->id)}}">
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
                    <input type="text" class="form-control" placeholder="" name="nama_latin" value="{{$spesies->nama_latin ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Umum</label>
                    <input type="text" class="form-control" placeholder="" name="nama_umum" value="{{$spesies->nama_umum ?? ''}}"> 
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
                      <select class="form-control" name="status" id="status">
                        <option value="" selected>---Pilih Status---</option>
                        <option value="valid">Valid</option>
                        <option value="verified">Verified</option>
                        <option value="checking">Checking</option>
                      </select>  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Gambar</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar">
                        <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                      </div>
                    </div>
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
                    <input type="text" class="form-control" placeholder="" name="kd_spesimen" value="{{$spesies->kd_spesimen ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="lokasi_penemuan">Lokasi Penemuan</label>
                    <input type="text" class="form-control" placeholder="" name="nama_lokasi" value="{{$spesies->nama_lokasi ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Provinsi Penemuan</label>
                    <select class="form-control" name="provinsi_id" id="provinsi">
                        <option disabled selected>---Pilih Provinsi---</option>
                        @foreach($provinsi as $data_provinsi)
                        <option value="{{$data_provinsi->id}}">{{$data_provinsi->nama_provinsi}}</option>
                        @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kabupaten Penemuan</label>
                      <select class="form-control" name="kabupaten_id" id="kabupaten">
                        <option value="" selected>---Pilih Kabupaten---</option>
                      </select>  
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kecamatan Penemuan</label>
                      <select class="form-control" name="kecamatan_id" id="kecamatan">
                        <option value="" selected>---Pilih Kecamatan---</option>
                      </select> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Tanggal Penemuan</label>
                    <input type="date" class="form-control" name="tanggal_penemuan" value="{{$spesies->tanggal_penemuan ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kolektor</label>
                    <input type="text" class="form-control" name="kolektor" value="{{$spesies->kolektor ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Rantai DNA</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="rantai_dna">
                        <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lokasi_penemuan">Lokasi Penyimpanan</label>
                    <input type="text" class="form-control" placeholder="" name="lokasi_penyimpanan" value="{{$spesies->lokasi_penyimpanan ?? ''}}">
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

@endsection
@section("linkfooter")
<script src="{{asset('js/wilayah.js')}}"></script>
<script src="{{asset('asset_dashboard/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   
</script>
@endsection
