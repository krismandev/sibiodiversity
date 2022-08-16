@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route("home.dashboard")}}">Home</a></li>
<li class="breadcrumb-item active">Spesies</li>
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
            <a href="{{route('spesies.create')}}" class="btn btn-primary">Tambah</a>
            {{-- <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Tambah</button> --}}
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="data_spesies_reguler">
              <thead>
                <tr>
                  <th>Spesies (Latin)</th>
                  <th>Nama Umum</th>
                  <th>Genus</th>
                  <th>Deskripsi</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($spesieses != null)
                @foreach ($spesieses as $spesies)
                <tr>
                  <td>{{$spesies->nama_latin}}</td>
                  <td>{{$spesies->nama_umum}}</td>
                  <td>{{$spesies->genus->nama_latin}}</td>
                  <td>{!!Str::limit($spesies->deskripsi,200)!!}</td>
                  <td>
                    <img src="{{$spesies->getImage()}}" alt="" style="max-width: 150px;">
                  </td>
                  <td>
                      <a class="btn btn-warning" href="{{route('spesies.edit',encrypt($spesies->id))}}">Edit</a>
                      <a class="btn btn-danger" href="#"
                      data-spesies_id="{{encrypt($spesies->id)}}">Hapus</a>
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
    
  $("#data_spesies_reguler").DataTable({
      "responsive": true,
      "autoWidth": false,
  });

  $(".btn-danger").click(function (e) {
      const spesies_id = $(this).data("spesies_id");

      swal({
          title: "Yakin?",
          text: "Mau menghapus data ini?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              window.location = "/dashboard/spesies/delete/"+spesies_id;
          }
      });
  });
</script>
@endsection
