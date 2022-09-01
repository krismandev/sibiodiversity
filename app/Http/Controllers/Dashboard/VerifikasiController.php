<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Spesies;

class VerifikasiController extends Controller
{
    public function index()
    {
        $title = "Data Pengajuan Spesies Ikan";
        $spesieses = Spesies::where('is_approved',0)->orderBy("created_at")->get();
        return view('dashboard.verifikasi.index',compact(['spesieses','title']));
    }

    
    public function detail($id)
    {
      
        $title = "Detail Data Pengajuan Spesies Ikan";
        $data_id = decrypt($id);
        $spesies = Spesies::find($data_id);
  
        return view('dashboard.verifikasi.detail',compact(['spesies','title']));
    }

    public function update($id)
    {
        $data_id = decrypt($id);
        $spesies = Spesies::find($data_id);
        $spesies->update([
            "is_approved" =>1,
        ]);

        return redirect()->route('verifikasi.index')->with('success','Berhasil mengubah data');

    }


}
