<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $guarded = [];

    public function getGallery()
    {
        if ($this->file_gallery != null) {
            return asset('storage/spesies/'.$this->file_gallery);
        }else{
            return asset('asset_dashboard/images/default_fish.png');
        }
    }

}
