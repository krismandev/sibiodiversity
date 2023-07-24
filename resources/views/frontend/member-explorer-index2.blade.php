@extends("layouts.frontend.master")
@section("title","Daftar Spesies Anda")
@push('css')
        <!-- css for this page only -->
        <link href="{{asset('asset_dashboard/vendor/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
        <link href="{{asset('asset_dashboard/vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet" />
@endpush
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
            {{ $dataTable->table() }}
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
<script src="{{asset('asset_dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('asset_dashboard/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset_dashboard/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
{{ $dataTable->scripts()}}
<script type="text/javascript">
 $('#spesies-table').on('click','.action-hapus', function(){
    let data = $(this).data()
    let id = data.id

    swal({
          title: "Yakin?",
          text: "Mau menghapus data ini?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              window.location = "/member/delete/"+id;
              $('#spesies-table').DataTable().ajax.reload();
          }
      });



 });

</script>
@endsection
