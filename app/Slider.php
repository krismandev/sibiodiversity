<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
    protected $guarded = [];

    public function getSlider()
    {
        if ($this->gambar != null) {
            return url('slider/'.$this->gambar);
        }else{
            return url('asset_dashboard/images/default_fish.png');
        }
    }
}
