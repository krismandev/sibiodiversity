@extends("layouts.frontend.master")
@section("title","Daftar Spesies Anda")
@section("content")

<!-- Breadcrumb section -->
<div class="site-breadcrumb">
    <div class="container">
        <a href="#"><i class="fa fa-home"></i> Beranda</a> <i class="fa fa-angle-right"></i>
        <span>Tambah Spesies Baru</span>
    </div>
</div>
<!-- Breadcrumb section end -->
<!-- Courses section -->
<section class="full-courses-section spad pt-0">
    <div class="container">
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
          <div class="card-tools text-right">
            <a href="{{route('member-explorer.create')}}" class="btn btn-primary">Tambah</a>
          </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data_spesies_reguler">
                <thead>
                    <tr>
                    <th>Gambar</th>
                    <th>Nama Umum</th>
                    <th>Status</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($spesieses != null)
                    @foreach ($spesieses as $spesies)
                    <tr>
                    <td>
                        <img src="{{$spesies->getImage()}}" alt="" style="max-width: 150px;">
                    </td>
                    <td>{{$spesies->nama_umum}}</td>
                    <td>
                        @if($spesies->status == 'checking')
                        <div class="badge badge-warning">{{$spesies->status}}</div>
                        @elseif($spesies->status == 'verified')
                        <div class="badge badge-info">{{$spesies->status}}</div>
                        @elseif($spesies->status == 'valid')
                        <div class="badge badge-success">{{$spesies->status}}</div>
                        @endif
                    </td>
                   
                    <td>
                        <a class="btn btn-warning" href="{{route('member-explorer.edit',encrypt($spesies->id))}}">Edit</a>
                        <a class="btn btn-danger" href="#"
                        data-spesies_id="{{encrypt($spesies->id)}}">Hapus</a>
                    </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
       
    </div>
    
</section>
<!-- Courses section end-->
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
              window.location = "/member/delete/"+spesies_id;
          }
      });
  });
</script>
@endsection