<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';
    protected $fillable = ['nama_latin','nama_umum','ciri_ciri','keterangan'];

    public function ordo()
    {
        return $this->hasMany(Ordo::class,'class_id','id');
    }
}
