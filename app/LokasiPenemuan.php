<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiPenemuan extends Model
{
    protected $table = 'lokasi_penemuan';
    protected $guarded = [];

    public function detail_spesimen()
    {
        return $this->hasOne(DetailSpesimen::class,"lokasi_penemuan_id","id");
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
}
