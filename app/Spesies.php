<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spesies extends Model
{
    protected $table = 'spesies';
    // protected $fillable = ['genus_id','nama_latin','nama_umum','deskripsi','genus_id','meristik','status_konservasi_id','potensi','keaslian_jenis','distribusi_global','gambar','is_approved','user_id'];
    protected $guarded = [];

    public function genus()
    {
        return $this->belongsTo(Genus::class);
    }

    public function getImage()
    {
        if ($this->gambar != null) {
            return asset('storage/spesies/'.$this->gambar);
        }else{
            return asset('asset_dashboard/images/default_fish.png');
        }
    }

    public function status_konservasi()
    {
        return $this->belongsTo(StatusKonservasi::class);
    }


    public function detail_spesimen()
    {
        return $this->hasOne(DetailSpesimen::class,"spesies_id","id");
    }
    public function next(){
        return $this->where('id','>',$this->id)->orderBy('id')->first();
    }

    public function previous(){
        return $this->where('id','<',$this->id)->orderBy('id')->first();
    }
}
