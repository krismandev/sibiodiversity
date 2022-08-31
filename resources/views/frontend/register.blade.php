@extends("layouts.frontend.master")
@section("title","Daftar sebagai member")
@section("content")
<div class="site-breadcrumb">
	<div class="container">
		<a href="{{route('home.frontend')}}"><i class="fa fa-home"></i> Beranda</a> <i class="fa fa-angle-right"></i>
		<span>Daftar</span>
	</div>
</div>
<section class="contact-page spad pt-0">
    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{session("error")}}
        </div>
        @endif
        <div class="contact-form spad pb-0">
            <div class="section-title text-center">
                <h3>Mendaftar sebagai member</h3>
                <p>Dengan mendaftar sebagai member, kamu dapat mengupload data spesies ikan</p>
            </div>
            <form class="comment-form --contact" action="{{route('storeRegister')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <input type="text" class="form-control"  placeholder="Nama" name="name" required value="{{old('name')}}">
                    </div>
                    <div class="col-lg-12">
                        <input type="email" class="form-control"  placeholder="Email" name="email" value="{{old('email')}}">
                    </div>
                    <div class="col-lg-12">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="col-lg-12 mt-3">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation">
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="L">
                            <label class="form-check-label" for="exampleRadios1">
                                Laki laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios2" value="P">
                            <label class="form-check-label" for="exampleRadios2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <input type="text" class="form-control"  placeholder="Pekerjaan" name="pekerjaan" value="{{old('pekerjaan')}}">
                    </div>
                    <div class="col-lg-12">
                        <input type="text" class="form-control"  placeholder="No HP" name="no_hp" value="{{old('no_hp')}}">
                    </div>
                    <div class="col-lg-12">
                        <textarea placeholder="Alamat" name="alamat"></textarea>
                        <div class="text-center">
                            <button type="submit" class="site-btn">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection