<?php

namespace App\Http\Controllers\Dashboard;

use App\ClassModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::orderBy("nama_latin")->get();
        return view('dashboard.master.class.index',compact(['classes']));
    }

    public function create()
    {
        return view('dashboard.master.class.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama_latin" =>"required",
            "nama_umum" =>"required",
            "ciri_ciri" =>"nullable",
            "keterangan" =>"nullable",
        ]);

        ClassModel::create([
            "nama_latin" => $request->nama_latin,
            "nama_umum" => $request->nama_umum,
            "ciri_ciri" => $request->ciri_ciri,
            "keterangan" => $request->keterangan,
        ]);

        return redirect()->route('class.index')->with('success','Berhasil menambah data');
    }
}
