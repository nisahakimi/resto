<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    protected $guarded = [];

    public function order(){
        return $this -> belongsTo(Order::class,'id_order');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class,'id_menu');
    }
}
