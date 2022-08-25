<?php

namespace App\Http\Controllers\Dashboard;

use App\Genus;
use App\Http\Controllers\Controller;
use App\Spesies;
use App\StatusKonservasi;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use Illuminate\Http\Request;

class SpesiesController extends Controller
{
    public function getKabupaten(Request $request){
    
        $kabupaten = Kabupaten::where("provinsi_id",$request->provinsi_id)->pluck('id','nama_kabupaten');
    
        return response()->json($kabupaten);
    }
    
    public function getKecamatan(Request $request){
    
        $kecamatan = Kecamatan::where("kabupaten_id",$request->kabupaten_id)->pluck('id','nama_kecamatan');
        return response()->json($kecamatan);
    }


    public function customValidate($request)
    {
        $fields = [
            "nama_latin" =>"required",
            "nama_umum" =>"required",
            "meristik" =>"nullable",
            "status_konservasi_id" =>"nullable",
            "deskripsi" =>"nullable",
            "potensi" =>"nullable",
            "keaslian_jenis" =>"nullable",
            "distribusi_global" =>"nullable",
            "gambar" =>"nullable|file|mimes:jpg,jpeg,png,gif",
            "genus_id" =>"required",
        ];
        $request->validate($fields);
    }

    public function index()
    {
        $title = "Data Spesies Ikan";
        $spesieses = Spesies::orderBy("nama_latin")->get();
        return view('dashboard.master.spesies.index',compact(['spesieses','title']));
    }

    public function create()
    {
        $title = "Tambah Spesies Ikan Baru";
        $genuses = Genus::orderBy("nama_latin")->get();
        $status_konservasis = StatusKonservasi::all();
        $provinsi = Provinsi::all();
        return view('dashboard.master.spesies.create',compact(['title','genuses','status_konservasis','provinsi']));
    }

    public function store(Request $request)
    {
        $this->customValidate($request);

        try {
            $nama_gambar = null;
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $nama_gambar = time()."_".$gambar->getClientOriginalName();
                $tujuan_upload = 'spesies';
                $gambar->move($tujuan_upload,$nama_gambar);
            }
            Spesies::create([
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
                "user_id"=>auth()->user()->id
            ]);
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('spesies.index')->with('success','Berhasil menambah data');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $title = "Edit Spesies Ikan";
        $spesies = Spesies::find($id);
        $genuses = Genus::orderBy("nama_latin")->get();
        $status_konservasis = StatusKonservasi::all();
        return view('dashboard.master.spesies.create',compact(['spesies','title','genuses','status_konservasis']));
    }

    public function update(Request $request)
    {
        $this->customValidate($request);
        $id = decrypt($request->spesies_id);
        $spesies = Spesies::find($id);
        try {
            $nama_gambar = null;
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $nama_gambar = time()."_".$gambar->getClientOriginalName();
                $tujuan_upload = 'spesies';
                $gambar->move($tujuan_upload,$nama_gambar);
            }
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
                "user_id"=>auth()->user()->id
            ]);
        } catch (\Exception $e){
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('spesies.index')->with('success','Berhasil mengubah data');

    }

    public function delete($id)
    {
        try {
            $id = decrypt($id);
            $spesies = Spesies::find($id);
            $spesies->delete();
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
        
        return redirect()->route('spesies.index')->with('success','Berhasil menghapus data');
    }
}
