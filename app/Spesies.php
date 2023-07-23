<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
                // Ini adalah gambar .heic atau .heif
                // Lakukan konversi ke format PNG (atau format lain sesuai kebutuhan)
                $image = Image::make($imagePath);
                $convertedPath = 'spesies/' . time() . rand(5, 1) . '.png';
                $image->store('public/' . $convertedPath);
    
                return asset('storage/' . $convertedPath);
            } else {
                // Ini adalah gambar selain .heic atau .heif
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
