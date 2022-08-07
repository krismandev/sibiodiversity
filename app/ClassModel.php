<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'class';
    protected $fillable = ['nama_latin','nama_umum','ciri_ciri','keterangan'];
}
