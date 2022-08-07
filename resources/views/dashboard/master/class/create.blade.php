@extends("layouts.dashboard.master")
@section("page_title","Data Class")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route("home.dashboard")}}">Home</a></li>
<li class="breadcrumb-item active">Class</li>
@endsection
@section("title","Class")
@section("content")
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h4>{{$title}}</h4>
          <div class="card-tools">
            {{-- <a href="{{route('class.create')}}" class="btn btn-primary">Tambah</a> --}}
            {{-- <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Tambah</button> --}}
          </div>
        </div>
        <div class="card-body p-0">
            <form role="form" action="{{isset($class) ? route('class.update') : route('class.store')}}" method="post">
                @if(isset($class))
                  @csrf
                  @method("PATCH")
                  <input type="hidden" name="class_id" value="{{encrypt($class->id)}}">
                @else
                  @csrf
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLatin">Nama Latin</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama latin" name="nama_latin" value="{{$class->nama_latin ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Umum</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama latin" name="nama_umum" value="{{$class->nama_umum ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Ciri - ciri</label>
                    <textarea name="ciri_ciri"  cols="30" rows="5" class="form-control ckeditor">{{$class->ciri_ciri ?? ''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Keterangan</label>
                    <textarea name="keterangan" cols="30" rows="5" class="form-control ckeditor">{{$class->keterangan ?? ''}}</textarea>
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
