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
            return asset('storage/slider/'.$this->gambar);
        }else{
            return url('assets_frontend/img/hero-slider/1.jpg');
        }
    }
}
