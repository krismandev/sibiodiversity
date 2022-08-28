<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';
    protected $guarded = [];

    public function lokasi_penemuan()
    {
        return $this->hasMany(LokasiPenemuan::class,"provinsi_id","id");
    }

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class,"provinsi_id","id");
    }
}
