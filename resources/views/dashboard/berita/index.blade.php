@extends("layouts.dashboard.master")
@section("page_title","Berita")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Berita</li>
@endsection
@section("title","Berita")
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
            <a href="{{route('berita.create')}}" class="btn btn-primary">Tambah</a>
            {{-- <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Tambah</button> --}}
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="data_berita_reguler">
              <thead>
                <tr>
        
                  <th>Gambar</th>
                  <th>Judul</th>
                  <th>Isi</th>
                
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($berita != null)
                @foreach ($berita as $b)
                <tr>
                  <td><img src="{{$b->getBerita()}}" alt="" style="max-width: 150px;"></td>
                  <td>{{$b->judul}}</td>
                  <td>{!!Str::limit($b->isi,200)!!}</td>
                  <td>
                      <a class="btn btn-warning" href="{{route('berita.edit',encrypt($b->id))}}">Edit</a>
                      <a class="btn btn-danger" href="#"
                      data-berita_id="{{encrypt($b->id)}}">Hapus</a>
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
    
  $("#data_berita_reguler").DataTable({
      "responsive": true,
      "autoWidth": false,
  });
  $(".btn-danger").click(function (e) {
      const berita_id = $(this).data("berita_id");
      swal({
          title: "Yakin?",
          text: "Mau menghapus data ini?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              window.location = "/dashboard/berita/delete/"+berita_id;
          }
      });
  });
</script>
@endsection

