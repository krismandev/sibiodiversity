@extends("layouts.dashboard.master")
@section("page_title","Data Slider")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Slider</li>
@endsection
@section("title","Slider")
@section("content")
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <h4>{{$title}}</h4>
        <div class="card-tools">
          <a href="{{route('slider.create')}}" class="btn btn-primary">Tambah</a> 
        </div>
      </div>
      <div class="card-body p-0">
          <form role="form" action="{{isset($slider) ? route('slider.update') : route('slider.store')}}" method="post" enctype="multipart/form-data">
              @if(isset($slider))
                @csrf
                @method("PATCH")
                <input type="hidden" name="slider_id" value="{{encrypt($slider->id)}}">
              @else
                @csrf
              @endif
              <div class="card-body">
                <div class="form-group">
                  <label for="namaLatin">Title</label>
                  <input type="text" class="form-control" placeholder="Masukkan Title Slider" name="title" value="{{$slider->title ?? ''}}">
                </div>
                <div class="form-group">
                  <label for="namaLatin">Subtitle</label>
                  <input type="text" class="form-control" placeholder="Masukkan Subtitle Slider" name="subtitle" value="{{$slider->subtitle ?? ''}}">
                </div>
               
                <div class="form-group">
                <label for="exampleInputFile">Gambar Slider</label>
                      @if(isset($slider) && $slider->gambar != Null)
                        <small>*Abaikan jika tidak ingin mengubah Foto</small>                            
                      @endif
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar">
                      <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                      
                    </div>
                    
                  </div>
                </div>
                <div class="form-group">
                  <label for="ciriCiri">Keterangan</label>
                  <textarea name="keterangan" cols="30" rows="5" class="form-control ckeditor">{{$slider->keterangan ?? ''}}</textarea>
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