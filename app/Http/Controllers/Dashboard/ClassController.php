<?php

namespace App\Http\Controllers\Dashboard;

use App\ClassModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function customValidate($request)
    {
        $fields = [
            "nama_latin" =>"required",
            "nama_umum" =>"required",
            "ciri_ciri" =>"nullable",
            "keterangan" =>"nullable",
        ];
        $request->validate($fields);
    }

    public function index()
    {
        $classes = ClassModel::orderBy("nama_latin")->get();
        return view('dashboard.master.class.index',compact(['classes']));
    }

    public function create()
    {
        $title = "Buat Class Baru";
        return view('dashboard.master.class.create',compact(['title']));
    }

    public function store(Request $request)
    {
        $this->customValidate($request);

        ClassModel::create([
            "nama_latin" => $request->nama_latin,
            "nama_umum" => $request->nama_umum,
            "ciri_ciri" => $request->ciri_ciri,
            "keterangan" => $request->keterangan,
        ]);

        return redirect()->route('class.index')->with('success','Berhasil menambah data');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $title = "Edit Class";
        $class = ClassModel::find($id);
        return view('dashboard.master.class.create',compact(['class','title']));
    }

    public function update(Request $request)
    {
        $this->customValidate($request);
        $id = decrypt($request->class_id);
        $class = ClassModel::find($id);
        try {
            $class->update([
                "nama_latin" => $request->nama_latin,
                "nama_umum" => $request->nama_umum,
                "ciri_ciri" => $request->ciri_ciri,
                "keterangan" => $request->keterangan,
            ]);
        } catch (\Exception $e){
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('class.index')->with('success','Berhasil mengubah data');

    }

    public function delete($id)
    {
        try {
            $id = decrypt($id);
            $class = ClassModel::find($id);
            $class->delete();
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
        
        return redirect()->route('class.index')->with('success','Berhasil menghapus data');
    }
}
