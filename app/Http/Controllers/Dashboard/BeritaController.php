<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Berita;

class BeritaController extends Controller
{
    public function customValidate($request)
    {
        $fields = [
            "judul" =>"required",
            "isi" =>"required",
            "file_berita" =>"file",
        ];
        $request->validate($fields);
    }

    public function index()
    {
        $berita = Berita::orderBy("created_at")->get();
        return view('dashboard.berita.index',compact(['berita']));
    }

    public function create()
    {
        $title = "Tambahkan Berita Baru";
        return view('dashboard.berita.create',compact(['title']));
    }

    public function store(Request $request)
    {
        
        $this->customValidate($request);
        DB::beginTransaction();
        try {
        
            $file_berita = $request->file('file_berita');
            $nama_file_berita = time()."_".$file_berita->getClientOriginalName();
            $tujuan_upload = 'berita';
            $file_berita->move($tujuan_upload,$nama_file_berita);
            

            $berita = Berita::create([
                "user_id"=>auth()->user()->id,
                "judul" =>$request->judul,
                "isi"=>$request->isi,
                "file_berita" =>$nama_file_berita,
            ]);

           
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
        DB::commit();

        return redirect()->route('berita.index')->with('success','Berhasil menambah data');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $title = "Edit Berita";
        $berita = Berita::find($id);
       
        return view('dashboard.berita.create',compact(['berita','title']));
    }

    public function update(Request $request)
    {
        $this->customValidate($request);
        DB::beginTransaction();
        try {
            $id = decrypt($request->berita_id);
            $berita = Berita::find($id);
            $nama_file_berita = $berita->file_berita;

            if ($request->hasFile('file_berita')) {
                $file_berita = $request->file('file_berita');
                $new_file_berita = time()."_".$file_berita->getClientOriginalName();
                $tujuan_upload = 'berita';
                $file_berita->move($tujuan_upload,$new_file_berita);
            
            $berita->update([
                "user_id"=>auth()->user()->id,
                "judul" =>$request->judul,
                "isi"=>$request->isi,
                "file_berita" =>$new_file_berita,
            ]);
        }else{
            $berita->update([
                "user_id"=>auth()->user()->id,
                "judul" =>$request->judul,
                "isi"=>$request->isi,
                "file_berita" =>$nama_file_berita,
            ]);
        }


            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('berita.index')->with('success','Berhasil mengubah data');

    }

    public function delete($id)
    {
        try {
            $id = decrypt($id);
            $berita = Berita::find($id);
            $berita->delete();
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
        
        return redirect()->route('berita.index')->with('success','Berhasil menghapus data');
    }
}
