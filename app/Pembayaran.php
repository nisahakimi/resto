<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    //
    protected $guarded = [];

    public function order(){
        return $this -> belongsTo(Order::class,'id_order');
    }

}
