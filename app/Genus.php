<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genus extends Model
{
    protected $table = 'genus';
    protected $fillable = ['nama_latin','nama_umum','ciri_ciri','keterangan','famili_id'];

    public function famili()
    {
        return $this->belongsTo(Famili::class);
    }
    public function spesies()
    {
        return $this->hasMany(Spesies::class);
    }
}
