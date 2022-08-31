<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Spesies;
use App\Gallery;
use App\Berita;
use App\Tentang;
use App\User;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tentang = Tentang::first();
        $judul='Tentang Sibiodiversity';
        return view('frontend.index',compact(['tentang','judul']));
    }

    public function explorer()
    {
        $data_spesies = Spesies::orderBy("nama_latin")->paginate(10);
        return view('frontend.explorer', compact(['data_spesies']));
    }

    public function explorerDetail($id)
    {
        $data = Spesies::find($id);
        $data_spesies = Spesies::latest()->paginate(5);
        $next = $data->next();
        $previous = $data->previous();
        return view('frontend.explorer-detail', compact(['data','data_spesies','next','previous']));
    }

    public function gallery()
    {
        $gallery = Gallery::latest()->paginate(5);
        return view('frontend.gallery',compact(['gallery']));
    }

    public function berita()
    {
        $data_berita = Berita::latest()->paginate(5);
        $berita_terbaru = Berita::latest()->paginate(5);
        return view('frontend.berita',compact(['data_berita','berita_terbaru']));
    }

    public function beritaDetail($id)
    {
        $berita = Berita::find($id);
        $berita_terbaru = Berita::latest()->paginate(5);
        $next = $berita->next();
        $previous = $berita->previous();
        return view('frontend.berita-detail', compact(['berita','berita_terbaru','next','previous']));
    }

    public function cariBerita(Request $request){
       
        $data_berita = Berita::where('judul' , $request->cari)->orWhere('judul','like','%'.$request->cari.'%')->paginate(5);
        $berita_terbaru = Berita::latest()->paginate(5);
        return view('frontend.berita',compact(['data_berita','berita_terbaru']));
       
    }

    public function filterExplorer(Request $request)
    {
        if ($request->abjad == "all") {
            $data_spesies = Spesies::orderBy("nama_latin")->paginate(9);
        }else if(isset($request->abjad)){
            $data_spesies = Spesies::where(function($query) use($request){
                $query->where("nama_latin","LIKE",$request->abjad."%")
                    ->orWhere("nama_umum","LIKE",$request->abjad."%");
            })->paginate(10);
        }else{
            //berarti param filter nya keyword search
            $data_spesies = Spesies::where(function($query) use($request){
                $query->where("nama_latin","LIKE","%".$request->search."%")
                    ->orWhere("nama_umum","LIKE","%".$request->search."%");
            })->paginate(10);
        }
        return view('frontend.partials.item-list-explorer',compact(['data_spesies']))->render();
    }

    public function register()
    {
        return view('frontend.register');
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "email"=>"required|email",
            "password"=>"required|min:8|confirmed",
            // "password_confirmation"=>"required|confirmed",
            "jenis_kelamin"=>"required",
            "pekerjaan"=>"nullable",
            "no_hp"=>"nullable",
            "alamat"=>"nullable",
        ]);

        try {
            $user = User::create([
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>bcrypt($request->password),
                "jenis_kelamin"=>$request->jenis_kelamin,
                "pekerjaan"=>$request->pekerjaan,
                "no_hp"=>$request->no_hp,
                "alamat"=>$request->alamat,
                "role"=>1
            ]);
    
            Auth::attempt(["email"=>$request->email, "password"=>$request->password]);
    
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
        return redirect()->route('home.frontend');
    }

    
}
