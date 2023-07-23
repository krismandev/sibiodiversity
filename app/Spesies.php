<?php

namespace App;

use Maestroerror\HeicToJpg;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Spesies extends Model
{
    protected $table = 'spesies';
    protected $guarded = [];

    public function genus()
    {
        return $this->belongsTo(Genus::class);
    }

    public function getImage()
    {
        if ($this->gambar != null) {
            $imagePath = public_path('storage/spesies/' . $this->gambar);
            $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
            $heicExtensions = ['heic', 'heif'];

            if (in_array(strtolower($extension), $heicExtensions)) {
                $jpgLocalPath = public_path('storage/spesies/' . pathinfo($this->gambar, PATHINFO_FILENAME) . '.jpg');

                // Convert HEIC to JPG using intervention/image
                try {
                    Image::make($imagePath)->save($jpgLocalPath, 90);
                } catch (\Exception $e) {
                    // If conversion fails, return the original HEIC image URL
                    return asset('storage/spesies/' . $this->gambar);
                }

            } else {
                return asset('storage/spesies/' . $this->gambar);
            }
        } else {
            return asset('asset_dashboard/images/default_fish.png');
        }
    }

    public function status_konservasi()
    {
        return $this->belongsTo(StatusKonservasi::class);
    }


    public function detail_spesimen()
    {
        return $this->hasOne(DetailSpesimen::class,"spesies_id","id");
    }
    public function next(){
        return $this->where('id','>',$this->id)->orderBy('id')->first();
    }

    public function previous(){
        return $this->where('id','<',$this->id)->orderBy('id')->first();
    }
}
