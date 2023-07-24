@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Data Spesies</li>
@endsection
@section("title",$title)
@push('css')
    <!-- css for this page only -->
    <link href="{{asset('asset_dashboard/vendor/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('asset_dashboard/vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet" />

@endpush
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
            {{ $dataTable->table() }}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

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
                    window.location = "/dashboard/spesies/delete/"+id;
                    $('#spesies-table').DataTable().ajax.reload();
                }
            });



 });

</script>
@endsection
