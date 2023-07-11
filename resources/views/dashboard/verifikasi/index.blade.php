@extends("layouts.dashboard.master")
@section("page_title",$title)
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
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
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="data_spesies_reguler">
              <thead>
                <tr>
                  <th>Spesies (Latin)</th>
                  <th>Nama Umum</th>
                  <th>Genus</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($spesieses != null)
                @foreach ($spesieses as $spesies)
                <tr>
                  <td>{!! $spesies->nama_latin !!}</td>
                  <td>{!! $spesies->nama_umum !!}</td>
                  <td>{!! $spesies->genus->nama_latin !!}</td>
                  <td>
                    <img src="{{$spesies->getImage()}}" alt="Gambar Spesies" style="max-width: 150px;">
                  </td>
                  <td>
                      <a class="btn btn-sm btn-danger" href="{{route('verifikasi.delete',encrypt($spesies->id))}}">Hapus</a>
                      <a class="btn btn-sm btn-info" href="{{route('verifikasi.detail',encrypt($spesies->id))}}">Detail</a>
                      <a class="btn btn-sm btn-success" href="{{route('verifikasi.update',encrypt($spesies->id))}}">Verifikasi</a>
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

</script>
@endsection
