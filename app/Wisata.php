<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisatas';
    protected $fillable = [
     'nama', 'alamat', 'no_telp', 'keterangan', 'lat', 'long', 'foto', 'id_user', 'id_kategori',
 ];   
    public function category(){
        return $this->belongsTo('App\Category', 'id_kategori');
    }
}
