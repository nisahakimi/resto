<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $guarded = [];

    public function meja(){
        return $this -> belongsTo(Meja::class,'id_menu');
    }
}
