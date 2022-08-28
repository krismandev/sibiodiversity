@extends('layouts.dashboard.master')
@section("title","Informasi Tentang Sibiodiversity")
@section('content')

<div class="main-content">
  <section class="section">
    <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
              <h4>{{$title}}</h4>
          </div>
          <div class="card-body p-0">
              <form role="form" action="{{isset($tentang) ? route('tentang.update') : route('tentang.store')}}" method="post" enctype="multipart/form-data">
                  @if(isset($tentang))
                    @csrf
                    @method("PATCH")
                    <input type="hidden" name="tentang_id" value="{{encrypt($tentang->id)}}">
                  @else
                    @csrf
                  @endif
                  <div class="card-body">
                    
                   
                    
                    <div class="form-group">
                      <label for="ciriCiri">Deskripsi</label>
                      <textarea name="isi" cols="30" rows="5" class="form-control ckeditor">{{$tentang->isi ?? ''}}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Gambar</label>
                          @if(isset($tentang) && $tentang->gambar != Null)
                            <small>*Abaikan jika tidak ingin mengubah Foto</small>                            
                          @endif
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar">
                          <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                          
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  
    </div>
  </section>
</div>

@endsection