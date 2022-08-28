<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Gallery;

class GalleryController extends Controller
{
    public function customValidate($request)
    {
        $fields = [
            "judul" =>"required",
            "jenis_file" =>"required",
            "file_gallery" =>"file",
            "keterangan" =>"required",
        ];
        $request->validate($fields);
    }

    public function index()
    {
        $gallery = Gallery::orderBy("created_at")->get();
        return view('dashboard.gallery.index',compact(['gallery']));
    }

    public function create()
    {
        $title = "Tambahkan Foto/Video Baru";
        return view('dashboard.gallery.create',compact(['title']));
    }

    public function store(Request $request)
    {
        
        $this->customValidate($request);
        DB::beginTransaction();
        try {
        
            $file_gallery = $request->file('file_gallery');
            $nama_file_gallery = time()."_".$file_gallery->getClientOriginalName();
            $tujuan_upload = 'gallery';
            $file_gallery->move($tujuan_upload,$nama_file_gallery);
            

            $gallery = Gallery::create([
                "user_id"=>auth()->user()->id,
                "judul" =>$request->judul,
                "file_gallery" =>$nama_file_gallery,
                "jenis_file" =>$request->jenis_file,
                "keterangan"=>$request->keterangan,
            ]);

           
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
        DB::commit();

        return redirect()->route('gallery.index')->with('success','Berhasil menambah data');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $title = "Edit Foto/Video Gallery";
        $gallery = Gallery::find($id);
       
        return view('dashboard.gallery.create',compact(['gallery','title']));
    }

    public function update(Request $request)
    {
        $this->customValidate($request);
        DB::beginTransaction();
        try {
            $id = decrypt($request->gallery_id);
            $gallery = Gallery::find($id);
            $nama_file_gallery = $gallery->file_gallery;

            if ($request->hasFile('file_gallery')) {
                $file_gallery = $request->file('file_gallery');
                $new_file_gallery = time()."_".$file_gallery->getClientOriginalName();
                $tujuan_upload = 'gallery';
                $file_gallery->move($tujuan_upload,$new_file_gallery);
            
            $gallery->update([
                "user_id"=>auth()->user()->id,
                "judul" =>$request->judul,
                "file_gallery" =>$new_file_gallery,
                "jenis_file" =>$request->jenis_file,
                "keterangan"=>$request->keterangan,
            ]);
        }else{
            $gallery->update([
                "user_id"=>auth()->user()->id,
                "judul" =>$request->judul,
                "file_gallery" =>$nama_file_gallery,
                "jenis_file" =>$request->jenis_file,
                "keterangan"=>$request->keterangan,
            ]);
        }


            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('gallery.index')->with('success','Berhasil mengubah data');

    }

    public function delete($id)
    {
        try {
            $id = decrypt($id);
            $gallery = Gallery::find($id);
            $gallery->delete();
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
        
        return redirect()->route('gallery.index')->with('success','Berhasil menghapus data');
    }
}
