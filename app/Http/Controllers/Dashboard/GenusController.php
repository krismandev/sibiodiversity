<?php

namespace App\Http\Controllers\Dashboard;

use App\Famili;
use App\Genus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenusController extends Controller
{
    public function customValidate($request)
    {
        $fields = [
            "nama_latin" =>"required",
            "nama_umum" =>"required",
            "famili_id" =>"required",
            "ciri_ciri" =>"nullable",
            "keterangan" =>"nullable",
        ];
        $request->validate($fields);
    }

    public function index()
    {
        $title = "Data Genus";
        $genuses = Genus::orderBy("nama_latin")->get();
        return view('dashboard.master.genus.index',compact(['genuses','title']));
    }

    public function create()
    {
        $title = "Tambah Genus Baru";
        $families = Famili::orderBy("nama_latin")->get();
        return view('dashboard.master.genus.create',compact(['title','families']));
    }

    public function store(Request $request)
    {
        $this->customValidate($request);

        try {
            Genus::create([
                "famili_id" => $request->famili_id,
                "nama_latin" => $request->nama_latin,
                "nama_umum" => $request->nama_umum,
                "ciri_ciri" => $request->ciri_ciri,
                "keterangan" => $request->keterangan,
            ]);
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('genus.index')->with('success','Berhasil menambah data');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $title = "Edit Genus";
        $genus = Genus::find($id);
        $families = Famili::orderBy("nama_latin")->get();
        return view('dashboard.master.genus.create',compact(['genus','title','families']));
    }

    public function update(Request $request)
    {
        $this->customValidate($request);
        $id = decrypt($request->genus_id);
        $genus = Genus::find($id);
        try {
            $genus->update([
                "famili_id" => $request->famili_id,
                "nama_latin" => $request->nama_latin,
                "nama_umum" => $request->nama_umum,
                "ciri_ciri" => $request->ciri_ciri,
                "keterangan" => $request->keterangan,
            ]);
        } catch (\Exception $e){
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('genus.index')->with('success','Berhasil mengubah data');

    }

    public function delete($id)
    {
        try {
            $id = decrypt($id);
            $genus = Genus::find($id);
            $genus->delete();
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
        
        return redirect()->route('genus.index')->with('success','Berhasil menghapus data');
    }
}
