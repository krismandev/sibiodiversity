<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    protected $table = 'tentang';
    protected $guarded = [];

    public function getTentang()
    {
        if ($this->gambar != null) {
            return url('tentang/'.$this->gambar);
        }else{
            return url('asset_dashboard/images/default_fish.png');
        }
    }
}
