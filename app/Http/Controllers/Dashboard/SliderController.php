<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function customValidate($request)
    {
        $fields = [
            "subtitle" =>"nullable",
            "title" =>"required",
            "gambar" =>"file",
            "keterangan" =>"nullable",
        ];
        $request->validate($fields);
    }

    public function index()
    {
        $slider = Slider::orderBy("created_at")->get();
        return view('dashboard.setting.slider.index',compact(['slider']));
    }

    public function create()
    {
        $title = "Tambahkan Gambar Slider Baru";
        return view('dashboard.setting.slider.create',compact(['title']));
    }

    public function store(Request $request)
    {
        
        $this->customValidate($request);
        DB::beginTransaction();
        try {
        
            $gambar = $request->file('gambar');
            $nama_gambar = time()."_".$gambar->getClientOriginalExtension();
            // $tujuan_upload = 'slider';
            // $gambar->move($tujuan_upload,$nama_gambar);
            $upload = Storage::putFileAs('public/slider',$request->file('gambar'),$nama_gambar);
            

            $slider = Slider::create([
                
                "subtitle" =>$request->subtitle,
                "title" =>$request->title,
                "gambar" =>$nama_gambar,
                "keterangan"=>$request->keterangan,
            ]);

           
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
        DB::commit();

        return redirect()->route('slider.index')->with('success','Berhasil menambah data');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $title = "Edit Foto Slider";
        $slider = Slider::find($id);
       
        return view('dashboard.setting.slider.create',compact(['slider','title']));
    }

    public function update(Request $request)
    {
        $this->customValidate($request);
        DB::beginTransaction();
        try {
            $id = decrypt($request->slider_id);
            $slider = Slider::find($id);
            $nama_gambar = $slider->gambar;

            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $new_gambar = time()."_".$gambar->getClientOriginalExtension();
                $tujuan_upload = 'slider';
                $gambar->move($tujuan_upload,$new_gambar);
            
            $slider->update([
                "subtitle" =>$request->subtitle,
                "title" =>$request->title,
                "gambar" =>$new_gambar,
                "keterangan"=>$request->keterangan,
            ]);
        }else{
            $slider->update([
                "subtitle" =>$request->subtitle,
                "title" =>$request->title,
                "gambar" =>$nama_gambar,
                "keterangan"=>$request->keterangan,
            ]);
        }


            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('slider.index')->with('success','Berhasil mengubah data');

    }

    public function delete($id)
    {
        try {
            $id = decrypt($id);
            $slider = Slider::find($id);
            $slider->delete();
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
        
        return redirect()->route('slider.index')->with('success','Berhasil menghapus data');
    }
}
