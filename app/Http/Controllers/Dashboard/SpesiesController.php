<?php

namespace App\Http\Controllers\Dashboard;

use App\DetailSpesimen;
use App\Genus;
use App\Http\Controllers\Controller;
use App\Spesies;
use App\StatusKonservasi;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\LokasiPenemuan;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
            // "provinsi_id" =>"required",
            // "kabupaten_id" =>"required",
            // "kecamatan_id" =>"required",
            // "nama_lokasi" =>"required",
            // "kolektor" =>"required",
            "rantai_dna" =>"nullable|file",
            "lokasi_penyimpanan" =>"nullable",
            "rujukan" =>"nullable",
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
        // dd($request->all());
        DB::beginTransaction();
        try {
            $nama_gambar = null;
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $nama_gambar = time()."_".$gambar->getClientOriginalName();
                $tujuan_upload = 'spesies';
                $gambar->move($tujuan_upload,$nama_gambar);
            }

            $lokasi_penemuan = LokasiPenemuan::create([
                "nama_lokasi"=>"Sungai Batanghari",
                "provinsi_id"=>8,
                "kabupaten_id"=>293,
                "kecamatan_id"=>4133,
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
                "rujukan"=>$request->rujukan,
                "is_approved"=>1,
            ]);

            if ($request->hasFile('rantai_dna')) {
                $rantai_dna = $request->file('rantai_dna');
                $nama_rantai_dna = time()."_".$rantai_dna->getClientOriginalName();
                $tujuan_upload = 'spesies/rantai_dna';
                $rantai_dna->move($tujuan_upload,$nama_rantai_dna);
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

        return redirect()->route('spesies.index')->with('success','Berhasil menambah data');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $title = "Edit Spesies Ikan";
        $spesies = Spesies::find($id);
        $genuses = Genus::orderBy("nama_latin")->get();
        $status_konservasis = StatusKonservasi::all();
        $provinsi = Provinsi::all();
        return view('dashboard.master.spesies.create',compact(['spesies','title','genuses','status_konservasis','provinsi']));
    }

    public function update(Request $request)
    {
        $this->customValidate($request);
        DB::beginTransaction();
        try {
            $id = decrypt($request->spesies_id);
            $spesies = Spesies::find($id);
            $detail_spesimen = DetailSpesimen::find($request->detail_spesimen_id);

            $nama_gambar = null;
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $nama_gambar = time()."_".$gambar->getClientOriginalName();
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
                $tujuan_upload = 'spesies/rantai_dna';
                $rantai_dna->move($tujuan_upload,$nama_rantai_dna);
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
