<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Gallery;
use App\Spesies;
use Image;
use Maestroerror\HeicToJpg;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function customValidate($request)
    {
        $fields = [
            "spesies_id" =>"required",
            "jenis_file" =>"required",
            "file_gallery" =>"file",
            // "keterangan" =>"required",
        ];
        $request->validate($fields);
    }

    public function index()
    {
        $gallery = Gallery::orderBy("created_at","desc")->get();
        return view('dashboard.gallery.index',compact(['gallery']));
    }

    public function create()
    {
        $title = "Tambahkan Foto/Video Baru";
        $spesieses = Spesies::all();
        return view('dashboard.gallery.create',compact(['title','spesieses']));
    }

    public function store(Request $request)
    {
        
        $this->customValidate($request);
        DB::beginTransaction();
        try {

            // $filenameWithExt = $request->file("file_gallery")->getClientOriginalName();
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // $extension = $request->file("file_gallery")->getClientOriginalExtension();
            // $filenameSave = time().".jpg";

            // // dd($filenameWithExt);

            // $destinationPath = public_path('/storage/spesies');
            // if (!file_exists($destinationPath)) {
            //     mkdir($destinationPath, 755, false);
            // }

            // $image = $request->file('file_gallery');
            // $img = Image::make($image->path());
            // // dd($img);
            // $img->orientate()->resize(1000, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save($destinationPath.'/'.$filenameSave);


            $file_gallery = $request->file('file_gallery');
            $temp_nama_file_gallery = time().".jpg";
            // $tujuan_upload = 'gallery';
            // $file_gallery->move($tujuan_upload,$nama_file_gallery);
            // $upload = Storage::putFileAs('public/spesies',$request->file('file_gallery'),$nama_file_gallery);

            HeicToJpg::convert($request->file('file_gallery')->path())->saveAs(public_path('/storage/spesies/'.$temp_nama_file_gallery));
            

            $img = Image::make(public_path('/storage/spesies/'.$temp_nama_file_gallery));
            // dd($img);
            $nama_file_gallery = time().rand(5,1).".jpg";
            $img->orientate()->resize(2000, 2000, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/storage/spesies').'/'.$nama_file_gallery);


            //hapus gambar yang belum di compress dari storage
            Storage::delete('public/spesies/'.$temp_nama_file_gallery);

            $gallery = Gallery::create([
                "user_id"=>auth()->user()->id,
                "spesies_id"=>$request->spesies_id,
                "judul" =>Spesies::find($request->spesies_id)->nama_latin,
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
                $nama_file_gallery = time()."_".$file_gallery->getClientOriginalExtension();
                // $tujuan_upload = 'gallery';
                // $file_gallery->move($tujuan_upload,$nama_file_gallery);
                $upload = Storage::putFileAs('public/spesies',$request->file('file_gallery'),$nama_file_gallery);
            
            $gallery->update([
                "user_id"=>auth()->user()->id,
                "judul" =>$request->judul,
                "file_gallery" =>$nama_file_gallery,
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
