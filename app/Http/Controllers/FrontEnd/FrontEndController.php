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
use Stichoza\GoogleTranslate\GoogleTranslate;
use App;
use Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\DataTables\SpesiesFrontEndDataTable;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }

    public function index()
    {
        $tentang = Tentang::first();
        $slider = Slider::all();
        $data_berita = Berita::latest()->take(4)->get();
        $judul='Tentang Biodiversitas Sungai Batanghari';
        return view('frontend.index',compact(['tentang','judul','slider','data_berita']));
    }

    public function explorer(Request $request)
    {

        if ($request->abjad == "all") {
            $data_spesies = Spesies::orderBy("nama_latin");
        }else if(isset($request->abjad)){
            $data_spesies = Spesies::where(function($query) use($request){
                $query->where("nama_latin","LIKE",$request->abjad."%")
                    ->orWhere("nama_umum","LIKE",$request->abjad."%");
            });
        }else if(isset($request->search)){
            //berarti param filter nya keyword search
            $data_spesies = Spesies::where(function($query) use($request){
                $query->where("nama_latin","LIKE","%".$request->search."%")
                    ->orWhere("nama_umum","LIKE","%".$request->search."%");
            });
        }else{
            $data_spesies = Spesies::orderBy("nama_latin");
        }

        $data_spesies = $data_spesies->paginate(12);
        foreach ($data_spesies as $key => $each) {
            $data_spesies[$key]->list_gambar = json_decode($each->gambar) ?? [];
            $data_spesies[$key]->gambar = json_decode($each->gambar)[0] ?? "";
        }
        return view('frontend.explorer', compact(['data_spesies']));
    }

    public function explorerDetail(Request $request,$id)
    {
        $page_url = url()->full();
        $data = Spesies::find($id);
        $data->list_gambar = json_decode($data->gambar) ?? [];
        $data->gambar = json_decode($data->gambar) ? json_decode($data->gambar)[0] : "";
        $data_spesies = Spesies::latest()->paginate(5);
        foreach ($data_spesies as $key => $each) {
            $data_spesies[$key]->list_gambar = json_decode($each->gambar) ?? [];
            $data_spesies[$key]->gambar = json_decode($each->gambar)[0] ?? "";
        }
        $next = $data->next();
        $previous = $data->previous();
        return view('frontend.explorer-detail', compact(['data','data_spesies','next','previous']));
    }

    public function gallery()
    {
        $gallery = Gallery::latest()->paginate(6);
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
            $data_spesies = Spesies::orderBy("nama_latin")->paginate(12);
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

    public function explorerIndex(SpesiesFrontEndDataTable $dataTable)
    {
        // $spesieses = Spesies::where('user_id', Auth::user()->id)->orderBy("nama_latin")->get();
        // return view('frontend.member-explorer-index',compact(['spesieses']));
        return $dataTable->render('frontend.member-explorer-index2');
        
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
            "kondisi_air"=>"nullable",
            "etnosains"=>"nullable",
            "gambar" =>"nullable|file|mimes:jpg,jpeg,png,gif",
            "genus_id" =>"required",
            "provinsi_id" =>"required",
            "kabupaten_id" =>"required",
            "kecamatan_id" =>"required",
            "nama_lokasi" =>"required",
            "kolektor" =>"required",
            // "rantai_dna" =>"nullable|file",
            "lokasi_penyimpanan" =>"nullable",
            "rujukan" =>"nullable",
        ]; 
        $request->validate($fields);
    }

    public function explorerStore(Request $request)
    {
        // dd($request);
        $this->customValidate($request);
        // dd($request->all());
        DB::beginTransaction();
        try {
            $arr_nama_gambar = [];
            if (count($request->gambar) > 0) {
                foreach ($request->gambar as $gambar) {
                    // $gambar = $request->file('gambar');
                    // dd($gambar);
                    $nama_gambar = time().rand(5,1).".".$gambar->getClientOriginalExtension();
                    $arr_nama_gambar[] = $nama_gambar;
                    // $tujuan_upload = 'spesies';
                    // $gambar->move($tujuan_upload,$nama_gambar);
                    $upload = Storage::putFileAs('public/spesies',$gambar,$nama_gambar);

                    Gallery::create([
                        "user_id"=>auth()->user()->id,
                        "judul" =>$request->nama_latin,
                        "file_gallery" =>$nama_gambar,
                        "jenis_file" =>"Gambar",
                    ]);
                }
            }
            $json_nama_gambar = json_encode($arr_nama_gambar);
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
                "kondisi_air"=>$request->kondisi_air,
                "etnosains"=>$request->etnosains,
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
                // "rantai_dna"=> $nama_rantai_dna ?? null,
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

    public function deleteGambar($nama_gambar,$id)
    {
        $spesies = Spesies::find($id);

        $arr_nama_gambar = json_decode($spesies->gambar) ?? [];

        if (($key = array_search($nama_gambar, $arr_nama_gambar)) !== false) {
            unset($arr_nama_gambar[$key]);
        }
        $json_nama_gambar = json_encode($arr_nama_gambar);
        $spesies->update([
            "gambar"=>$json_nama_gambar
        ]);

        return back()->with('success','Berhasil menghapus gambar');
    }

    public function storeToCookie(array $data)
    {
        // dd($data);
    }


}
