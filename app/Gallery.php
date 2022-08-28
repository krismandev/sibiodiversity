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
            return url('gallery/'.$this->file_gallery);
        }else{
            return url('asset_dashboard/images/default_fish.png');
        }
    }

}
