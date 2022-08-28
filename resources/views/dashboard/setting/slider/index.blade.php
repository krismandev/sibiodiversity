@extends("layouts.dashboard.master")
@section("page_title","Slider")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
<li class="breadcrumb-item active">Slider</li>
@endsection
@section("title","Slider")
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
            <a href="{{route('slider.create')}}" class="btn btn-primary">Tambah</a>
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="data_slider_reguler">
              <thead>
                <tr>
        
                  <th>Gambar</th>
                  <th>Subtitle</th>
                  <th>Title</th>
                  <th>Keterangan</th>
                
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($slider != null)
                @foreach ($slider as $s)
                <tr>
                  <td>
                    <img src="{{$s->getSlider()}}" alt=""  style="max-width: 150px;" >
                  </td>
                  <td>{{$s->subtitle}}</td>
                  <td>{{$s->title}}</td>
                  <td>{!!Str::limit($s->keterangan,200)!!}</td>
                  <td>
                      <a class="btn btn-warning" href="{{route('slider.edit',encrypt($s->id))}}">Edit</a>
                      <a class="btn btn-danger" href="#"
                      data-slider_id="{{encrypt($s->id)}}">Hapus</a>
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
    
  $("#data_slider_reguler").DataTable({
      "responsive": true,
      "autoWidth": false,
  });
  $(".btn-danger").click(function (e) {
      const slider_id = $(this).data("slider_id");
      swal({
          title: "Yakin?",
          text: "Mau menghapus data ini?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              window.location = "/dashboard/slider/delete/"+slider_id;
          }
      });
  });
</script>
@endsection

