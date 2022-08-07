<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordo extends Model
{
    protected $table = 'ordo';
    protected $fillable = ['nama_latin','nama_umum','ciri_ciri','keterangan','class_id'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
}
