<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tentang;

class TentangController extends Controller
{

    public function customValidate($request)
    {
        $fields = [
            "isi" =>"required",
            "gambar" =>"file",
        ];
        $request->validate($fields);
    }

    public function index()
    {
        $tentang = Tentang::first();
        $title = "Informasi Tentang Sibiodiversity";
        return view('dashboard.setting.tentang.index',compact(['tentang','title']));
    }

    public function store(Request $request)
    {
        
        $this->customValidate($request);
        DB::beginTransaction();
        try {
        
            $gambar = $request->file('gambar');
            $nama_gambar = time()."_".$gambar->getClientOriginalName();
            $tujuan_upload = 'tentang';
            $gambar->move($tujuan_upload,$nama_gambar);
            

            $tentang = Tentang::create([
                
                "isi"=>$request->isi,
                "gambar" =>$nama_gambar,
            ]);

           
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
        DB::commit();

        return redirect()->route('tentang.index')->with('success','Berhasil menambah data');
    }

    public function update(Request $request)
    {
        $this->customValidate($request);
        DB::beginTransaction();
        try {
            $id = decrypt($request->tentang_id);
            $tentang = Tentang::find($id);
            $nama_gambar = $tentang->gambar;

            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $new_gambar = time()."_".$gambar->getClientOriginalName();
                $tujuan_upload = 'berita';
                $gambar->move($tujuan_upload,$new_gambar);
            
            $tentang->update([
                
                "isi"=>$request->isi,
                "gambar" =>$new_gambar,
            ]);
        }else{
            $tentang->update([
               
                "isi"=>$request->isi,
                "gambar" =>$nama_gambar,
            ]);
        }


            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('tentang.index')->with('success','Berhasil mengubah data');

    }


}
