<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $guarded = [];

    public function getBerita()
    {
        if ($this->file_berita != null) {
            return asset('storage/berita/'.$this->file_berita);
        }else{
            return url('asset_dashboard/images/default_fish.png');
        }
    }

    public function next(){
        return $this->where('id','>',$this->id)->orderBy('id')->first();
    }

    public function previous(){
        return $this->where('id','<',$this->id)->orderBy('id')->first();
    }
}
