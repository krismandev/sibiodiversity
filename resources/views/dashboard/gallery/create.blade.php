@extends("layouts.dashboard.master")
@section("page_title","Data Gallery")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Gallery</li>
@endsection
@section("title","Gallery")
@section("content")
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h4>{{$title}}</h4>
          <div class="card-tools">
            {{-- <a href="{{route('gallery.create')}}" class="btn btn-primary">Tambah</a> --}}
            {{-- <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Tambah</button> --}}
          </div>
        </div>
        <div class="card-body p-0">
            <form role="form" action="{{isset($gallery) ? route('gallery.update') : route('gallery.store')}}" method="post" enctype="multipart/form-data">
                @if(isset($gallery))
                  @csrf
                  @method("PATCH")
                  <input type="hidden" name="gallery_id" value="{{encrypt($gallery->id)}}">
                @else
                  @csrf
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLatin">Judul</label>
                    <input type="text" class="form-control" placeholder="Masukkan Judul Gambar/Video" name="judul" value="{{$gallery->judul ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Jenis File</label>
                      <select class="form-control" name="jenis_file" id="jenis_file" value="{{$gallery->jenis_file ?? ''}}">
                      @if(isset($gallery) && $gallery->jenis_file != Null)
                        <option value="" disabled selected>---Pilih Jenis File---</option>
                        <option value="Gambar" {{$gallery->jenis_file == 'Gambar'  ? 'selected' : '' }}>Gambar</option>
                        <option value="Video"  {{$gallery->jenis_file == 'Video'  ? 'selected' : '' }}>Video</option>                          
                      @else
                        <option value="" disabled selected>---Pilih Jenis File---</option>
                        <option value="Gambar" >Gambar</option>
                        <option value="Video">Video</option> 
                       
                      @endif
                      </select>  
                  </div>
                  <div class="form-group">
                  <label for="exampleInputFile">File Gallery</label>
                        @if(isset($gallery) && $gallery->file_gallery != Null)
                          <small>*Abaikan jika tidak ingin mengubah Foto/Video</small>                            
                        @endif
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file_gallery">
                        <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                       
                      </div>
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Keterangan</label>
                    <textarea name="keterangan" cols="30" rows="5" class="form-control ckeditor">{{$gallery->keterangan ?? ''}}</textarea>
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