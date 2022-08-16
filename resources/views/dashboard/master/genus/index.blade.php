@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route("home.dashboard")}}">Home</a></li>
<li class="breadcrumb-item active">Genus</li>
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
            <a href="{{route('genus.create')}}" class="btn btn-primary">Tambah</a>
            {{-- <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Tambah</button> --}}
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="data_genus_reguler">
              <thead>
                <tr>
                  <th>Genus (Latin)</th>
                  <th>Nama Umum</th>
                  <th>Famili</th>
                  <th>Ciri Ciri</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($genuses != null)
                @foreach ($genuses as $genus)
                <tr>
                  <td>{{$genus->nama_latin}}</td>
                  <td>{{$genus->nama_umum}}</td>
                  <td>{{$genus->famili->nama_latin}}</td>
                  <td>{!!Str::limit($genus->ciri_ciri,200)!!}</td>
                  <td>{!!Str::limit($genus->keterangan,200)!!}</td>
                  <td>
                      <a class="btn btn-warning" href="{{route('genus.edit',encrypt($genus->id))}}">Edit</a>
                      <a class="btn btn-danger" href="#"
                      data-ordo_id="{{encrypt($genus->id)}}">Hapus</a>
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
    
  $("#data_genus_reguler").DataTable({
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
              window.location = "/dashboard/genus/delete/"+ordo_id;
          }
      });
  });
</script>
@endsection
