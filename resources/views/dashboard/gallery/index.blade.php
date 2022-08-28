@extends("layouts.dashboard.master")
@section("page_title","Gallery")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Gallery</li>
@endsection
@section("title","Gallery")
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
            <a href="{{route('gallery.create')}}" class="btn btn-primary">Tambah</a>
            {{-- <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Tambah</button> --}}
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="data_gallery_reguler">
              <thead>
                <tr>
        
                  <th>Gambar/Video</th>
                  <th>Judul</th>
                  <th>Keterangan</th>
                
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($gallery != null)
                @foreach ($gallery as $g)
                <tr>
                  <td>
                    @if($g->jenis_file == "Gambar")
                    <img src="{{$g->getGallery()}}" alt="" style="max-width: 150px;">
                    @else
                    <video controls>
                      <source src="{{$g->getGallery()}}" type="video" />
                    </video>
                    @endif
                  </td>
                  <td>{{$g->judul}}</td>
                  <td>{!!Str::limit($g->keterangan,200)!!}</td>
                  <td>
                      <a class="btn btn-warning" href="{{route('gallery.edit',encrypt($g->id))}}">Edit</a>
                      <a class="btn btn-danger" href="#"
                      data-gallery_id="{{encrypt($g->id)}}">Hapus</a>
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
    
  $("#data_gallery_reguler").DataTable({
      "responsive": true,
      "autoWidth": false,
  });
  $(".btn-danger").click(function (e) {
      const gallery_id = $(this).data("gallery_id");
      swal({
          title: "Yakin?",
          text: "Mau menghapus data ini?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              window.location = "/dashboard/gallery/delete/"+gallery_id;
          }
      });
  });
</script>
@endsection

