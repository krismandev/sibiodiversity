@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route("home.dashboard")}}">Home</a></li>
<li class="breadcrumb-item active">Famili</li>
@endsection
@section("title","Famili")
@section("content")
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
          </div>
        </div>
        <div class="card-body p-0">
            <form role="form" action="{{isset($famili) ? route('famili.update') : route('famili.store')}}" method="post">
                @if(isset($famili))
                  @csrf
                  @method("PATCH")
                  <input type="hidden" name="famili_id" value="{{encrypt($famili->id)}}">
                @else
                  @csrf
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLatin">Pilih Ordo</label>
                    <select class="form-control" name="ordo_id">
                      <option>Pilih Ordo</option>
                      @if(isset($famili))
                      <option value="{{$famili->ordo_id}}" selected>{{$famili->ordo->nama_latin}}</option>
                      @endif
                      @foreach ($ordos as $ordo)
                      <option value="{{$ordo->id}}">{{$ordo->nama_latin}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Latin</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama latin" name="nama_latin" value="{{$famili->nama_latin ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Umum</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama latin" name="nama_umum" value="{{$famili->nama_umum ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Ciri - ciri</label>
                    <textarea name="ciri_ciri"  cols="30" rows="5" class="form-control ckeditor">{{$famili->ciri_ciri ?? ''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Keterangan</label>
                    <textarea name="keterangan" cols="30" rows="5" class="form-control ckeditor">{{$famili->keterangan ?? ''}}</textarea>
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
