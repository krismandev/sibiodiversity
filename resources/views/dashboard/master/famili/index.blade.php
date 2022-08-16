@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route("home.dashboard")}}">Home</a></li>
<li class="breadcrumb-item active">Famili</li>
@endsection
@section("title",$title)
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
          <div class="card-tools">
            <a href="{{route('famili.create')}}" class="btn btn-primary">Tambah</a>
            {{-- <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Tambah</button> --}}
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="data_famili_reguler">
              <thead>
                <tr>
                  <th>Famili (Latin)</th>
                  <th>Nama Umum</th>
                  <th>Ordo</th>
                  <th>Ciri Ciri</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($familis != null)
                @foreach ($familis as $famili)
                <tr>
                  <td>{{$famili->nama_latin}}</td>
                  <td>{{$famili->nama_umum}}</td>
                  <td>{{$famili->ordo->nama_latin}}</td>
                  <td>{!!Str::limit($famili->ciri_ciri,200)!!}</td>
                  <td>{!!Str::limit($famili->keterangan,200)!!}</td>
                  <td>
                      <a class="btn btn-warning" href="{{route('famili.edit',encrypt($famili->id))}}">Edit</a>
                      <a class="btn btn-danger" href="#"
                      data-famili_id="{{encrypt($famili->id)}}">Hapus</a>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

@endsection
@section("linkfooter")
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    
  $("#data_famili_reguler").DataTable({
      "responsive": true,
      "autoWidth": false,
  });

  $(".btn-danger").click(function (e) {
      const famili_id = $(this).data("famili_id");

      swal({
          title: "Yakin?",
          text: "Mau menghapus data ini?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              window.location = "/dashboard/famili/delete/"+famili_id;
          }
      });
  });
</script>
@endsection
