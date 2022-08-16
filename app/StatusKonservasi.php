<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusKonservasi extends Model
{
    protected $table = 'status_konservasi';
    protected $fillable = ['status_konservasi'];

    public function spesies()
    {
        return $this->hasMany(Spesies::class,'status_konservasi_id','id');
    }
}
