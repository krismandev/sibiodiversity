<?php

namespace App\Http\Controllers\Dashboard;

use Str;
use App\Genus;
use App\Gallery;
use App\Spesies;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\DetailSpesimen;
use App\LokasiPenemuan;
use App\StatusKonservasi;
use Maestroerror\HeicToJpg;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\SpesiesDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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


    public function customValidate($request){



    }

    public function index(SpesiesDataTable $dataTable)
    {
        $title = "Data Spesies Ikan";
        return $dataTable->render('dashboard.master.spesies.index2',compact('title'));
    }

    // public function index()
    // {
    //     $title = "Data Spesies Ikan";
    //     $spesieses = Spesies::orderBy("nama_latin")->get();
    //     foreach ($spesieses as $key => $each) {
    //         if ($each->gambar != null) {
    //             $spesieses[$key]->gambar = json_decode($each->gambar)[0] ?? "";
    //         }else{
    //             $spesieses[$key]->gambar = "";
    //         }
    //     }
    //     return view('dashboard.master.spesies.index',compact(['spesieses','title']));
    // }

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
        $fields = [
            //spesies
            "nama_latin" =>"required",
            "nama_umum" =>"required",
            "genus_id" =>"required",
            "meristik" =>"nullable",
            "status_konservasi_id" =>"required",
            "potensi" =>"nullable",
            "keaslian_jenis" =>"nullable",
            "distribusi_global" =>"nullable",
            "deskripsi" =>"nullable",
            "rujukan" =>"nullable",
            "gambar" =>"required",
            "status" =>"required",
            "kondisi_air" =>"nullable",
            "etnosains" =>"nullable",

            //detail
            "kolektor" =>"nullable",
            "lokasi_penyimpanan" =>"nullable",
            // "rantai_dna" =>"nullable",
            "tanggal_penemuan" =>"nullable",

            //lokasi
            "nama_lokasi" =>"required",
            "provinsi_id" =>"required",
            "kabupaten_id" =>"required",
            "kecamatan_id" =>"required",

        ];


        $customMessages = [
            "nama_latin.required" => "Kolom Nama Latin harus diisi.",
            "nama_umum.required" => "Kolom Nama Umum harus diisi.",
            "genus_id.required" => "Silahkan Pilih Salah Satu Genus.",
            "status_konservasi_id.required" => "Silahkan Pilih Salah Satu Status Konservasi.",
            "status.required" => "Silahkan Pilih Salah Satu Status.",
            "nama_lokasi.required" => "Kolom Nama Lokasi harus diisi.",
            "provinsi_id.required" => "Silahkan Pilih Salah Satu Provinsi.",
            "kabupaten_id.required" => "Silahkan Pilih Salah Satu Kabupaten.",
            "kecamatan_id.required" => "Silahkan Pilih Salah Satu Kecamatan.",
        ];

        // try {
        //     $request->validate($fields, $customMessages);
        // } catch (ValidationException $e) {
        //     // $errors = $e->validator->messages()->all()[0];
        //     $errors = implode(" ",$e->validator->messages()->all());
        //     return redirect()->back()->with('error',$errors);
        // }

        DB::beginTransaction();
        try {
            $arr_nama_gambar = [];
            if (count($request->gambar) > 0) {
                foreach ($request->gambar as $idx => $gbr) {
                    $gambar = $request->file('gambar')[$idx];
                    // dd($gambar);
                    // $nama_gambar = time().rand(5,1).".".$gambar->getClientOriginalExtension();
                    // $tujuan_upload = 'spesies';
                    // $gambar->move($tujuan_upload,$nama_gambar);
                    // $upload = Storage::putFileAs('public/spesies',$gambar,$nama_gambar);

                    $tempFilenameSave = time().".jpg";
                    // dd($filenameWithExt);

                    $destinationPath = public_path('/storage/spesies');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 755, false);
                    }

                    HeicToJpg::convert($gambar->path())->saveAs(public_path('/storage/spesies/'.$tempFilenameSave));

                    $image = $gambar;
                    $filenameSave = time().rand(5,1).".jpg";
                    $img = Image::make(public_path('/storage/spesies/'.$tempFilenameSave));
                    $img->orientate()->resize(2000, 2000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$filenameSave);

                    //
                    Storage::delete('public/spesies/'.$tempFilenameSave);
                    $arr_nama_gambar[] = $filenameSave;
                }

                // $upload = Storage::putFileAs('public/spesies', $gambar, $nama_gambar);

                // Gallery::create([
                //     "user_id" => auth()->user()->id,
                //     "judul" => $request->nama_latin,
                //     "file_gallery" => $nama_gambar,
                //     "jenis_file" => "Gambar",
                // ]);
            }

            $json_nama_gambar = json_encode($arr_nama_gambar);

            $lokasi_penemuan = LokasiPenemuan::create([
                "nama_lokasi" => $request->nama_lokasi,
                "provinsi_id" => $request->provinsi_id,
                "kabupaten_id" => $request->kabupaten_id,
                "kecamatan_id" => $request->kecamatan_id,
            ]);

            $spesies = Spesies::create([
                "genus_id" => $request->genus_id,
                "nama_latin" => $request->nama_latin,
                "nama_umum" => $request->nama_umum,
                "meristik" => $request->meristik,
                "status_konservasi_id" => $request->status_konservasi_id,
                "deskripsi" => $request->deskripsi,
                "potensi" => $request->potensi,
                "keaslian_jenis" => $request->keaslian_jenis,
                "distribusi_global" => $request->distribusi_global,
                "gambar" => $json_nama_gambar,
                "user_id" => auth()->user()->id,
                "status" => $request->status,
                "rujukan" => $request->rujukan,
                "kondisi_air" => $request->kondisi_air,
                "etnosains" => $request->etnosains,
                "is_approved" => 1,
            ]);

            if (count($request->gambar) > 0) {
                foreach ($arr_nama_gambar as $nama_gambar) {
                    Gallery::create([
                        "user_id"=>auth()->user()->id,
                        "spesies_id"=>$spesies->id,
                        "judul" =>$request->nama_latin,
                        "file_gallery" =>$nama_gambar,
                        "jenis_file" =>"Gambar",
                    ]);
                }
            }

            // if ($request->hasFile('rantai_dna')) {
            //     $rantai_dna = $request->file('rantai_dna');
            //     $nama_rantai_dna = time()."_".$rantai_dna->getClientOriginalExtension();
            //     // $tujuan_upload = 'spesies/rantai_dna';
            //     // $rantai_dna->move($tujuan_upload,$nama_rantai_dna);
            //     $upload = Storage::putFileAs('public/rantai_dna',$request->file('rantai_dna'),$nama_rantai_dna);
            // }
            // $rantai_dna = $request->rantai_dna;

            $detail_spesies = DetailSpesimen::create([
                "spesies_id"=>$spesies->id,
                "kd_spesimen"=>$request->kd_spesimen,
                "lokasi_penemuan_id"=>$lokasi_penemuan->id,
                "kolektor"=>$request->kolektor,
                "lokasi_penyimpanan"=>$request->lokasi_penyimpanan,
                // "rantai_dna"=> $nama_rantai_dna ?? null,
                "tanggal_penemuan"=>$request->tanggal_penemuan
            ]);
            DB::commit();
            return redirect()->route('spesies.index')->with('success','Berhasil menambah data');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }


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
            $nama_gambar_old = json_decode($spesies->gambar, true) ?? [];

            $arr_nama_gambar = json_decode($spesies->gambar, true) ?? [];
            if (count($request->gambar) > 0) {
                foreach ($request->gambar as $idx=> $gambar) {
                    $gambar = $request->file('gambar')[$idx];
                    // $gambar = $request->file('gambar');
                    // dd($gambar);
                    // $nama_gambar = time().rand(5,1).".".$gambar->getClientOriginalExtension();
                    // $arr_nama_gambar[] = $nama_gambar;
                    // // $tujuan_upload = 'spesies';
                    // // $gambar->move($tujuan_upload,$nama_gambar);
                    // $upload = Storage::putFileAs('public/spesies',$gambar,$nama_gambar);



                    $tempFilenameSave = time().".jpg";
                    // dd($filenameWithExt);

                    $destinationPath = public_path('/storage/spesies');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 755, false);
                    }

                    HeicToJpg::convert($gambar->path())->saveAs(public_path('/storage/spesies/'.$tempFilenameSave));

                    $filenameSave = time().rand(5,1).".jpg";
                    $img = Image::make(public_path('/storage/spesies/'.$tempFilenameSave));
                    $img->orientate()->resize(2000, 2000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$filenameSave);

                    //
                    Storage::delete('public/spesies/'.$tempFilenameSave);

                    Gallery::create([
                        "user_id"=>auth()->user()->id,
                        "spesies_id"=>$id,
                        "judul" =>$request->nama_latin,
                        "file_gallery" =>$filenameSave,
                        "jenis_file" =>"Gambar",
                    ]);
                }
            }
            $merge_nama_gambar = array_merge($nama_gambar_old,$arr_nama_gambar);
            $json_nama_gambar = json_encode($merge_nama_gambar);

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
                "gambar" =>$json_nama_gambar,
                "user_id"=>auth()->user()->id,
                "status"=>$request->status,
                "kondisi_air"=>$request->kondisi_air,
                "etnosains"=>$request->etnosains,
                "rujukan"=>$request->rujukan,
            ]);

            // if ($request->hasFile('rantai_dna')) {
            //     $rantai_dna = $request->file('rantai_dna');
            //     $nama_rantai_dna = time()."_".$rantai_dna->getClientOriginalExtension();
            //     // $tujuan_upload = 'spesies/rantai_dna';
            //     // $rantai_dna->move($tujuan_upload,$nama_rantai_dna);
            //     $upload = Storage::putFileAs('public/rantai_dna',$request->file('rantai_dna'),$nama_rantai_dna);
            // }

            $detail_spesimen->update([
                "spesies_id"=>$spesies->id,
                "kd_spesimen"=>$request->kd_spesimen,
                "lokasi_penemuan_id"=>$lokasi_penemuan->id,
                "kolektor"=>$request->kolektor,
                "lokasi_penyimpanan"=>$request->lokasi_penyimpanan,
                // "rantai_dna"=> $nama_rantai_dna ?? null,
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
}
