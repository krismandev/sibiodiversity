@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route("home.dashboard")}}">Home</a></li>
<li class="breadcrumb-item active">Ordo</li>
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
            <a href="{{route('ordo.create')}}" class="btn btn-primary">Tambah</a>
            {{-- <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Tambah</button> --}}
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="data_class_reguler">
              <thead>
                <tr>
                  <th>Ordo (Latin)</th>
                  <th>Nama Umum</th>
                  <th>Class</th>
                  <th>Ciri Ciri</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($ordos != null)
                @foreach ($ordos as $ordo)
                <tr>
                  <td>{{$ordo->nama_latin}}</td>
                  <td>{{$ordo->nama_umum}}</td>
                  <td>{{$ordo->class->nama_latin}}</td>
                  <td>{!!Str::limit($ordo->ciri_ciri,200)!!}</td>
                  <td>{!!Str::limit($ordo->keterangan,200)!!}</td>
                  <td>
                      <a class="btn btn-warning" href="{{route('ordo.edit',encrypt($ordo->id))}}">Edit</a>
                      <a class="btn btn-danger" href="#"
                      data-ordo_id="{{encrypt($ordo->id)}}">Hapus</a>
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
    
  $("#data_class_reguler").DataTable({
      "responsive": true,
      "autoWidth": false,
  });

  $(".btn-danger").click(function (e) {
      const ordo_id = $(this).data("ordo_id");

      swal({
          title: "Yakin?",
          text: "Mau menghapus data ini?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              window.location = "/dashboard/ordo/delete/"+ordo_id;
          }
      });
  });
</script>
@endsection
