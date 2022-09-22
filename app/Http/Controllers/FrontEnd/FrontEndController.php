<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Spesies;
use App\Gallery;
use App\Berita;
use App\Tentang;
use App\User;
use App\Slider;
use App\Genus;
use App\Provinsi;
use App\StatusKonservasi;
use App\DetailSpesimen;
use App\LokasiPenemuan;
use Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $slider = Slider::all();
        $data_berita = Berita::latest()->take(4)->get();;
        $judul='Tentang Sibiodiversity';
        return view('frontend.index',compact(['tentang','judul','slider','data_berita']));
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

    public function explorerIndex()
    {
        $spesieses = Spesies::where('user_id', Auth::user()->id)->orderBy("nama_latin")->get();
        return view('frontend.member-explorer-index',compact(['spesieses']));
    }
    public function explorerCreate()
    {
        $genuses = Genus::orderBy("nama_latin")->get();
        $status_konservasis = StatusKonservasi::all();
        $provinsi = Provinsi::all();
        return view('frontend.member-explorer-create',compact(['genuses','status_konservasis','provinsi']));
    }

    public function customValidate($request)
    {
        $fields = [
            "nama_latin" =>"required",
            "nama_umum" =>"required",
            "meristik" =>"nullable",
            "status_konservasi_id" =>"required",
            "deskripsi" =>"nullable",
            "potensi" =>"nullable",
            "keaslian_jenis" =>"nullable",
            "distribusi_global" =>"nullable",
            "gambar" =>"nullable|file|mimes:jpg,jpeg,png,gif",
            "genus_id" =>"required",
            "provinsi_id" =>"required",
            "kabupaten_id" =>"required",
            "kecamatan_id" =>"required",
            "nama_lokasi" =>"required",
            "kolektor" =>"required",
            "rantai_dna" =>"nullable|file",
            "lokasi_penyimpanan" =>"nullable",
            "rujukan" =>"nullable",
        ];
        $request->validate($fields);
    }

    public function explorerStore(Request $request)
    {
        $this->customValidate($request);
        // dd($request->all());
        DB::beginTransaction();
        try {
            $nama_gambar = null;
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $nama_gambar = time()."_".$gambar->getClientOriginalExtension();
                // $tujuan_upload = 'spesies';
                // $gambar->move($tujuan_upload,$nama_gambar);
                $upload = Storage::putFileAs('public/spesies',$request->file('gambar'),$nama_gambar);
            }

            $lokasi_penemuan = LokasiPenemuan::create([
                "nama_lokasi"=>$request->nama_lokasi,
                "provinsi_id"=>$request->provinsi_id,
                "kabupaten_id"=>$request->kabupaten_id,
                "kecamatan_id"=>$request->kecamatan_id,
            ]);

            $spesies = Spesies::create([
                "genus_id" =>$request->genus_id,
                "nama_latin" =>$request->nama_latin,
                "nama_umum" =>$request->nama_umum,
                "meristik" =>$request->meristik,
                "status_konservasi_id" =>$request->status_konservasi_id,
                "deskripsi" =>$request->deskripsi,
                "potensi" =>$request->potensi,
                "keaslian_jenis" =>$request->keaslian_jenis,
                "distribusi_global" => $request->distribusi_global,
                "gambar" =>$nama_gambar,
                "user_id"=>auth()->user()->id,
                "status"=>$request->status,
                "is_approved"=>0,
                "rujukan"=>$request->rujukan,
            ]);

            if ($request->hasFile('rantai_dna')) {
                $rantai_dna = $request->file('rantai_dna');
                $nama_rantai_dna = time()."_".$rantai_dna->getClientOriginalName();
                // $tujuan_upload = 'spesies/rantai_dna';
                // $rantai_dna->move($tujuan_upload,$nama_rantai_dna);
                $upload = Storage::putFileAs('public/rantai_dna',$request->file('gambar'),$nama_rantai_dna);
            }

            $detail_spesies = DetailSpesimen::create([
                "spesies_id"=>$spesies->id,
                "kd_spesimen"=>$request->kd_spesimen,
                "lokasi_penemuan_id"=>$lokasi_penemuan->id,
                "kolektor"=>$request->kolektor,
                "lokasi_penyimpanan"=>$request->lokasi_penyimpanan,
                "rantai_dna"=> $nama_rantai_dna ?? null,
                "tanggal_penemuan"=>$request->tanggal_penemuan
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
        DB::commit();

        return redirect()->route('member-explorer.index')->with('success','Berhasil menambah data');
    }

    public function explorerEdit($id)
    {
        $id = decrypt($id);
        $spesies = Spesies::find($id);
        $genuses = Genus::orderBy("nama_latin")->get();
        $provinsi = Provinsi::all();
        $status_konservasis = StatusKonservasi::all();
        return view('frontend.member-explorer-create',compact(['spesies','genuses','provinsi','status_konservasis']));
    }

    public function explorerUpdate(Request $request)
    {
        // dd($request);
        $this->customValidate($request);
        DB::beginTransaction();
        try {
            $id = decrypt($request->spesies_id);
            $spesies = Spesies::find($id);
            $detail_spesimen = DetailSpesimen::find($request->detail_spesimen_id);

            $nama_gambar = null;
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $nama_gambar = time()."_".$gambar->getClientOriginalExtension();
                // $tujuan_upload = 'spesies';
                // $gambar->move($tujuan_upload,$nama_gambar);
                $upload = Storage::putFileAs('public/spesies',$request->file('gambar'),$nama_gambar);
            }

            $lokasi_penemuan = $detail_spesimen->lokasi_penemuan;

            $lokasi_penemuan->update([
                "nama_lokasi"=>$request->nama_lokasi,
                "provinsi_id"=>$request->provinsi_id,
                "kabupaten_id"=>$request->kabupaten_id,
                "kecamatan_id"=>$request->kecamatan_id,
            ]);

            $spesies->update([
                "genus_id" =>$request->genus_id,
                "nama_latin" =>$request->nama_latin,
                "nama_umum" =>$request->nama_umum,
                "meristik" =>$request->meristik,
                "status_konservasi_id" =>$request->status_konservasi_id,
                "deskripsi" =>$request->deskripsi,
                "potensi" =>$request->potensi,
                "keaslian_jenis" =>$request->keaslian_jenis,
                "distribusi_global" => $request->distribusi_global,
                "gambar" =>$nama_gambar,
                "user_id"=>auth()->user()->id,
                "status"=>$request->status,
                "rujukan"=>$request->rujukan,
            ]);

            if ($request->hasFile('rantai_dna')) {
                $rantai_dna = $request->file('rantai_dna');
                $nama_rantai_dna = time()."_".$rantai_dna->getClientOriginalName();
                // $tujuan_upload = 'spesies/rantai_dna';
                // $rantai_dna->move($tujuan_upload,$nama_rantai_dna);
                $upload = Storage::putFileAs('public/rantai_dna',$request->file('gambar'),$nama_rantai_dna);
            }

            $detail_spesimen->update([
                "spesies_id"=>$spesies->id,
                "kd_spesimen"=>$request->kd_spesimen,
                "lokasi_penemuan_id"=>$lokasi_penemuan->id,
                "kolektor"=>$request->kolektor,
                "lokasi_penyimpanan"=>$request->lokasi_penyimpanan,
                "rantai_dna"=> $nama_rantai_dna ?? null,
                "tanggal_penemuan"=>$request->tanggal_penemuan
            ]);
            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('member-explorer.index')->with('success','Berhasil mengubah data');

    }

    public function explorerDelete($id)
    {
        try {
            $id = decrypt($id);
            $spesies = Spesies::find($id);
            $spesies->delete();
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
        
        return redirect()->route('member-explorer.index')->with('success','Berhasil menghapus data');
    }

    
}
