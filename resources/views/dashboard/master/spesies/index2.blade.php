@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Data Spesies</li>
@endsection
@section("title",$title)
@push('css')
    <!-- css for this page only -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
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
