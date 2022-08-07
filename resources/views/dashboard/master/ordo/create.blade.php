@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route("home.dashboard")}}">Home</a></li>
<li class="breadcrumb-item active">Ordo</li>
@endsection
@section("title","Class")
@section("content")
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
          </div>
        </div>
        <div class="card-body p-0">
            <form role="form" action="{{isset($ordo) ? route('ordo.update') : route('ordo.store')}}" method="post">
                @if(isset($ordo))
                  @csrf
                  @method("PATCH")
                  <input type="hidden" name="ordo_id" value="{{encrypt($ordo->id)}}">
                @else
                  @csrf
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLatin">Pilih Class</label>
                    <select class="form-control" name="class_id">
                      <option>Pilih Class</option>
                      @if(isset($ordo))
                      <option value="{{$ordo->class_id}}" selected>{{$ordo->class->nama_latin}}</option>
                      @endif
                      @foreach ($classes as $class)
                      <option value="{{$class->id}}">{{$class->nama_latin}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Latin</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama latin" name="nama_latin" value="{{$ordo->nama_latin ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Umum</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama latin" name="nama_umum" value="{{$ordo->nama_umum ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Ciri - ciri</label>
                    <textarea name="ciri_ciri"  cols="30" rows="5" class="form-control ckeditor">{{$ordo->ciri_ciri ?? ''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Keterangan</label>
                    <textarea name="keterangan" cols="30" rows="5" class="form-control ckeditor">{{$ordo->keterangan ?? ''}}</textarea>
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
   
</script>
@endsection
