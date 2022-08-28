@extends("layouts.dashboard.master")
@section("page_title","Data Berita")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Berita</li>
@endsection
@section("title","Berita")
@section("content")
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h4>{{$title}}</h4>
          <div class="card-tools">
            {{-- <a href="{{route('berita.create')}}" class="btn btn-primary">Tambah</a> --}}
            {{-- <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Tambah</button> --}}
          </div>
        </div>
        <div class="card-body p-0">
            <form role="form" action="{{isset($berita) ? route('berita.update') : route('berita.store')}}" method="post" enctype="multipart/form-data">
                @if(isset($berita))
                  @csrf
                  @method("PATCH")
                  <input type="hidden" name="berita_id" value="{{encrypt($berita->id)}}">
                @else
                  @csrf
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLatin">Judul</label>
                    <input type="text" class="form-control" placeholder="Masukkan Judul Beirta" name="judul" value="{{$berita->judul ?? ''}}">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputFile">Gambar</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file_berita">
                        <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                        @if(isset($berita) && $berita->file_berita != null)
                          <small>Abaikan jika tidak ingin mengubah Foto</small>                            
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">isi</label>
                    <textarea name="isi" cols="30" rows="5" class="form-control ckeditor">{{$berita->isi ?? ''}}</textarea>
                  </div>
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
<script src="{{asset('asset_dashboard/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    $(".edit-agency").click(function (e) {
        const agency_id = $(this).data("agency_id")
        const agency_name = $(this).data("name")
        $("#name_update").val(agency_name)
        $("#agency_id_update").val(agency_id)
    });
</script>
@endsection