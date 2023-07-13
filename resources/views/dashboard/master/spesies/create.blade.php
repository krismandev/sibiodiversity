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
                    <textarea name="nama_latin" cols="15" rows="2" class="form-control">{{$spesies->nama_latin ?? old('nama_latin')}}</textarea>

                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Umum</label>
                    <textarea name="nama_umum" cols="15" rows="2" class="form-control">{{$spesies->nama_umum ?? old('nama_umum')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Meristik</label>
                    <input type="text" class="form-control" placeholder="" name="meristik" value="{{$spesies->meristik ?? old('meristik')}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Status Konservasi</label>
                    <select class="form-control" name="status_konservasi_id">
                      <option disabled selected>Pilih Status Konservasi</option>
                      @if(isset($spesies))
                      <option value="{{$spesies->status_konservasi_id}}" selected>{{$spesies->status_konservasi->status_konservasi ?? ''}}</option>
                      @endif
                      @foreach ($status_konservasis as $status)
                      <option value="{{$status->id}}">{{$status->status_konservasi}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Potensi</label>
                    <input type="text" class="form-control" placeholder="" name="potensi" value="{{$spesies->potensi ?? old('potensi')}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Keaslian Jenis</label>
                    <input type="text" class="form-control" placeholder="" name="keaslian_jenis" value="{{$spesies->keaslian_jenis ?? old('keaslian_jenis')}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Distribusi Global</label>
                    <input type="text" class="form-control" placeholder="" name="distribusi_global" value="{{$spesies->distribusi_global ?? old('distribusi_global')}}">
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    @if(isset($spesies))
                      <select class="form-control" name="status" id="status">
                        <option value="" selected>---Pilih Status---</option>
                        <option value="valid" {{$spesies->status == "valid" ? 'selected' : ''}}>Valid</option>
                        <option value="verified" {{$spesies->status == "verified" ? 'selected' : ''}}>Verified</option>
                        <option value="checking" {{$spesies->status == "checking" ? 'selected' : ''}}>Checking</option>
                      </select>
                    @else
                    <select class="form-control" name="status" id="status">
                        <option value="" selected>---Pilih Status---</option>
                        <option value="valid">Valid</option>
                        <option value="verified">Verified</option>
                        <option value="checking">Checking</option>
                      </select>
                     @endif
                  </div>
                  {{-- <div class="form-group">
                    <label for="exampleInputFile">Gambar</label>
                        <input type="file" class="form-control" id="exampleInputFile" name="gambar">
                        @if (isset($spesies) && $spesies->gambar != null)
                          <small>Abaikan jika tidak ingin mengubah gambar</small>
                        @endif
                  </div> --}}
                  <div class="form-group">
                    <label for="">Gambar</label>
                    <div class="col-lg-12">
                      @if (isset($spesies) && $spesies->gambar != null)
                        @php
                            $arr_gambar = json_decode($spesies->gambar);
                        @endphp
                        <div class="row">
                          @foreach ($arr_gambar as $key => $value)
                          <div class="col-lg-3">
                            <div class="card">
                              {{-- <div class="card-header">
                              </div> --}}
                              <i class="fa fa-trash float-right delete-image" data-nama_gambar="{{$value}}" data-spesies_id="{{$spesies->id}}" style="color: red;"></i>
                              <img src="{{asset('storage/spesies/'.$value)}}" alt="" style="max-height: 80px;">
                            </div>
                          </div>
                          {{-- <div class="row mt-2">
                            <div class="col-lg-4">
                                <input type="text" class="form-control" placeholder="Dimensi Ukuran. Cth: Panjang, Berat, Lebar" name="key_ukuran[]" value="{{$key}}">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" placeholder="Nilai" name="value_ukuran[]" value="{{$value}}">
                            </div>
                            <div class="col-lg-2">
                                <a href="#" style="color: red;" class="btn-remove-row">Hapus</a>
                            </div>
                          </div> --}}

                          @endforeach
                        </div>
                      @else
                      @include('dashboard.master.spesies.partials.row-gambar')
                      @endif
                    </div>
                    <a title="Add New Row" href="#" class="mt-2 btn-add-row mb-4" data-target="#template-row">
                      <i data-feather="plus"></i> Tambah Gambar
                    </a>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kondisi Air</label>
                    <textarea name="kondisi_air" cols="15" rows="2" class="form-control">{{$spesies->kondisi_air ?? old('kondisi_air')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Deskripsi</label>
                    <textarea name="deskripsi" cols="30" rows="5" class="form-control ckeditor">{{$spesies->deskripsi ?? old('deskripsi')}}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="namaLatin">Etnosains</label>
                    <textarea name="etnosains" cols="15" rows="2" class="form-control ckeditor">{{$spesies->etnosains ?? old('etnosains')}}</textarea>
                  </div>
                </div>
                <div class="card-header">
                <h5>Detail Spesimen</h5>
                </div>
                <!-- /.card-body -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="lokasi_penemuan">Kode Spesimen</label>
                    <input type="text" class="form-control" placeholder="" name="kd_spesimen" value="{{$spesies->detail_spesimen->kd_spesimen ?? old('kd_spesimen')}}">
                  </div>
                  <div class="form-group">
                    <label for="lokasi_penemuan">Lokasi Penemuan</label>
                    <input type="text" class="form-control" placeholder="" name="nama_lokasi" value="{{$spesies->detail_spesimen->lokasi_penemuan->nama_lokasi ?? old('nama_lokasi')}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Provinsi Penemuan</label>
                    <select class="form-control" name="provinsi_id" id="provinsi">
                        <option disabled selected>---Pilih Provinsi---</option>
                        @if(isset($spesies->detail_spesimen->lokasi_penemuan->provinsi_id))
                          <option value="{{$spesies->detail_spesimen->lokasi_penemuan->provinsi_id}}">{{$spesies->detail_spesimen->lokasi_penemuan->provinsi->nama_provinsi}}</option>
                        @endif
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
                    <input type="date" class="form-control" name="tanggal_penemuan" value="{{$spesies->tanggal_penemuan ?? old('tanggal_penemuan')}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Kolektor</label>
                    <input type="text" class="form-control" name="kolektor" value="{{$spesies->kolektor ?? old('kolektor')}}">
                  </div>
                  {{-- <div class="form-group">
                    <label for="namaLatin">Rantai DNA</label>
                    <input type="text" class="form-control" name="rantai_dna" value="{{$spesies->rantai_dna ?? ''}}" placeholder="Masukkan link kontak yang bisa dihubungi. ex: http://wa.me/08xxx">
                  </div> --}}
                  <div class="form-group">
                    <label for="lokasi_penemuan">Lokasi Penyimpanan</label>
                    <input type="text" class="form-control" placeholder="" name="lokasi_penyimpanan" value="{{$spesies->lokasi_penyimpanan ?? old('lokasi_penyimpanan')}}">
                  </div>
                  <div class="form-group">
                    <label for="lokasi_penemuan">Rujukan</label>
                    <input type="text" class="form-control" placeholder="" name="rujukan" value="{{$spesies->rujukan ?? old('rujukan')}}">
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

  <template id="template-row">
    @include('dashboard.master.spesies.partials.row-gambar')
  </template>
@endsection
@section("linkfooter")
@include('dashboard.master.spesies.js.wilayah-js')
{{-- <script src="{{asset('js/wilayah.js')}}"></script> --}}
<script src="{{asset('asset_dashboard/plugins/ckeditor/ckeditor.js')}}"></script>
{{-- <script src="https://cdn.ckeditor.com/4.20.2/basic/ckeditor.js"></script> --}}
<script type="text/javascript">
$(document).ready(function () {
  CKEDITOR.replace('nama_latin');
  $(document).on('click', ".btn-add-row", function(e){
      e.preventDefault();


      targetClone = $(this).closest('.form-group').find('.col-lg-12 .row:last-child');
      target = $(this).attr('data-target');
      cln = $(target).html();

      targetClone.after(cln);
      $(".bs-tooltip").tooltip();
  });

  $(document).on('click', '.btn-remove-row', function(e){
    e.preventDefault();
    if($(this).closest('.col-lg-12').find('.row').length > 1){
			$(this).tooltip('hide');
			$(this).closest('.row').remove();
		}
		else{
			$(this).closest('.row').find('input').val('');
			$(this).closest('.row').find('input:first').focus();
		}
  });

  $(".delete-image").click(function (e) {
    let nama_gambar = $(this).data("nama_gambar");
    let spesies_id = $(this).data("spesies_id");
    e.preventDefault();
    swal({
          title: "Yakin?",
          text: "Mau menghapus gambar ini?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              window.location = "/dashboard/spesies/gambar/delete/"+nama_gambar+"/"+spesies_id;
          }
      });
  });
});
</script>
@endsection
