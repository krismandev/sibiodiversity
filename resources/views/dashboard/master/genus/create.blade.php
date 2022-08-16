@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route("home.dashboard")}}">Home</a></li>
<li class="breadcrumb-item active">Genus</li>
@endsection
@section("title","Genus")
@section("content")
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
          </div>
        </div>
        <div class="card-body p-0">
            <form role="form" action="{{isset($genus) ? route('genus.update') : route('genus.store')}}" method="post">
                @if(isset($genus))
                  @csrf
                  @method("PATCH")
                  <input type="hidden" name="genus_id" value="{{encrypt($genus->id)}}">
                @else
                  @csrf
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLatin">Pilih Famili</label>
                    <select class="form-control" name="famili_id">
                      <option>Pilih Famili</option>
                      @if(isset($genus))
                      <option value="{{$genus->famili_id}}" selected>{{$genus->famili->nama_latin}}</option>
                      @endif
                      @foreach ($families as $famili)
                      <option value="{{$famili->id}}">{{$famili->nama_latin}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Latin</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama latin" name="nama_latin" value="{{$genus->nama_latin ?? ''}}">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Umum</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama latin" name="nama_umum" value="{{$genus->nama_umum ?? ''}}"> 
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Ciri - ciri</label>
                    <textarea name="ciri_ciri"  cols="30" rows="5" class="form-control ckeditor">{{$genus->ciri_ciri ?? ''}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Keterangan</label>
                    <textarea name="keterangan" cols="30" rows="5" class="form-control ckeditor">{{$genus->keterangan ?? ''}}</textarea>
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
