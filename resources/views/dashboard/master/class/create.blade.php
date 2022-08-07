@extends("layouts.dashboard.master")
@section("page_title","Data Class")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
<li class="breadcrumb-item active">Class</li>
@endsection
@section("title","Class")
@section("content")
<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h4>Buat Data Class Baru</h4>
          <div class="card-tools">
            {{-- <a href="{{route('class.create')}}" class="btn btn-primary">Tambah</a> --}}
            {{-- <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Tambah</button> --}}
          </div>
        </div>
        <div class="card-body table-responsive p-0">
            <form role="form" action="{{route('class.store')}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="namaLatin">Nama Latin</label>
                    <input type="text" class="form-control" id="namaLatin" placeholder="Masukkan nama latin" name="nama_latin">
                  </div>
                  <div class="form-group">
                    <label for="namaLatin">Nama Umum</label>
                    <input type="text" class="form-control" id="namaLatin" placeholder="Masukkan nama latin" name="nama_umum">
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Ciri - ciri</label>
                    <textarea name="ciri_ciri" id="ciriCiri" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="ciriCiri">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control"></textarea>
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
<script type="text/javascript">
    $(".edit-agency").click(function (e) {
        const agency_id = $(this).data("agency_id")
        const agency_name = $(this).data("name")

        $("#name_update").val(agency_name)
        $("#agency_id_update").val(agency_id)

    });
</script>
@endsection
