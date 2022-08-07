<?php

namespace App\Http\Controllers\Dashboard;

use App\ClassModel;
use App\Http\Controllers\Controller;
use App\Ordo;
use Illuminate\Http\Request;

class OrdoController extends Controller
{
    public function customValidate($request)
    {
        $fields = [
            "nama_latin" =>"required",
            "nama_umum" =>"required",
            "class_id" =>"required",
            "ciri_ciri" =>"nullable",
            "keterangan" =>"nullable",
        ];
        $request->validate($fields);
    }

    public function index()
    {
        $title = "Data Ordo";
        $ordos = Ordo::orderBy("nama_latin")->get();
        return view('dashboard.master.ordo.index',compact(['ordos','title']));
    }

    public function create()
    {
        $title = "Tambah Ordo Baru";
        $classes = ClassModel::orderBy("nama_latin")->get();
        return view('dashboard.master.ordo.create',compact(['title','classes']));
    }

    public function store(Request $request)
    {
        $this->customValidate($request);

        try {
            Ordo::create([
                "class_id" => $request->class_id,
                "nama_latin" => $request->nama_latin,
                "nama_umum" => $request->nama_umum,
                "ciri_ciri" => $request->ciri_ciri,
                "keterangan" => $request->keterangan,
            ]);
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('ordo.index')->with('success','Berhasil menambah data');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $title = "Edit Ordo";
        $ordo = Ordo::find($id);
        $classes = ClassModel::orderBy("nama_latin")->get();
        return view('dashboard.master.ordo.create',compact(['ordo','title','classes']));
    }

    public function update(Request $request)
    {
        $this->customValidate($request);
        $id = decrypt($request->ordo_id);
        $ordo = Ordo::find($id);
        try {
            $ordo->update([
                "class_id" => $request->class_id,
                "nama_latin" => $request->nama_latin,
                "nama_umum" => $request->nama_umum,
                "ciri_ciri" => $request->ciri_ciri,
                "keterangan" => $request->keterangan,
            ]);
        } catch (\Exception $e){
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('ordo.index')->with('success','Berhasil mengubah data');

    }

    public function delete($id)
    {
        try {
            $id = decrypt($id);
            $ordo = Ordo::find($id);
            $ordo->delete();
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
        
        return redirect()->route('ordo.index')->with('success','Berhasil menghapus data');
    }
}
