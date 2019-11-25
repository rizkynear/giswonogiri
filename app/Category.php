<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'kategori', 'marker', 'id_user',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id_user')->withTrashed();
    }
    public function wisata(){
        return $this->hasOne('App\Wisata');
    }
}
