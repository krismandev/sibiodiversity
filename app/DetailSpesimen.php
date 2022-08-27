<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSpesimen extends Model
{
    protected $table = 'detail_spesimen';
    protected $guarded = [];

    public function spesies() {
        return $this->belongsTo(Spesies::class);
    }

    public function lokasi_penemuan()
    {
        return $this->belongsTo(LokasiPenemuan::class);
    }
}
