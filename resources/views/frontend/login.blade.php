@extends("layouts.frontend.master")
@section("title","Log In")
@section("content")
<div class="site-breadcrumb">
	<div class="container">
		<a href="{{route('home.frontend')}}"><i class="fa fa-home"></i> Beranda</a> <i class="fa fa-angle-right"></i>
		<span>Login</span>
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
                <h3>Login</h3>
                {{-- <p>Dengan mendaftar sebagai member, kamu dapat mengupload data spesies ikan</p> --}}
            </div>
            <form class="comment-form --contact" action="{{route('postLogin')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-8" style="margin: auto;">
                            <input type="email" class="form-control"  placeholder="Email" name="email" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-8" style="margin: auto;">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <div class="text-center">
                            <button type="submit" class="site-btn">Masuk</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection