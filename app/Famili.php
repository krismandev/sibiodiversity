<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Famili extends Model
{
    protected $table = 'famili';
    protected $fillable = ['nama_latin','nama_umum','ciri_ciri','keterangan','ordo_id'];

    public function ordo()
    {
        return $this->belongsTo(Ordo::class);
    }

    public function genus()
    {
        return $this->hasMany(Genus::class,'famili_id','id');
    }
}
