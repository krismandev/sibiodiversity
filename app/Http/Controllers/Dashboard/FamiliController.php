<?php

namespace App\Http\Controllers\Dashboard;

use App\Famili;
use App\Http\Controllers\Controller;
use App\Ordo;
use Illuminate\Http\Request;

class FamiliController extends Controller
{
    public function customValidate($request)
    {
        $fields = [
            "nama_latin" =>"required",
            "nama_umum" =>"required",
            "ordo_id" =>"required",
            "ciri_ciri" =>"nullable",
            "keterangan" =>"nullable",
        ];
        $request->validate($fields);
    }

    public function index()
    {
        $title = "Data Famili";
        $familis = Famili::orderBy("nama_latin")->get();
        return view('dashboard.master.famili.index',compact(['familis','title']));
    }

    public function create()
    {
        $title = "Tambah Famili Baru";
        $ordos = Ordo::orderBy("nama_latin")->get();
        return view('dashboard.master.famili.create',compact(['title','ordos']));
    }

    public function store(Request $request)
    {
        $this->customValidate($request);

        try {
            Famili::create([
                "ordo_id" => $request->ordo_id,
                "nama_latin" => $request->nama_latin,
                "nama_umum" => $request->nama_umum,
                "ciri_ciri" => $request->ciri_ciri,
                "keterangan" => $request->keterangan,
            ]);
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('famili.index')->with('success','Berhasil menambah data');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $title = "Edit Famili";
        $famili = Famili::find($id);
        $ordos = Ordo::orderBy("nama_latin")->get();
        return view('dashboard.master.famili.create',compact(['famili','title','ordos']));
    }

    public function update(Request $request)
    {
        $this->customValidate($request);
        $id = decrypt($request->famili_id);
        $famili = Famili::find($id);
        try {
            $famili->update([
                "ordo_id" => $request->ordo_id,
                "nama_latin" => $request->nama_latin,
                "nama_umum" => $request->nama_umum,
                "ciri_ciri" => $request->ciri_ciri,
                "keterangan" => $request->keterangan,
            ]);
        } catch (\Exception $e){
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('famili.index')->with('success','Berhasil mengubah data');

    }

    public function delete($id)
    {
        try {
            $id = decrypt($id);
            $famili = Famili::find($id);
            $famili->delete();
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
        
        return redirect()->route('famili.index')->with('success','Berhasil menghapus data');
    }
}
