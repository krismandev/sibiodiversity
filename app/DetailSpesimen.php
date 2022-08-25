<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSpesimen extends Model
{
    protected $table = 'detail_spesimen';
    protected $guarded = [];

    public function detail_spesimen() {
        return $this->belongsTo(DetailSpesimen::class);
    }
}
