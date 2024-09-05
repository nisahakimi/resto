<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $guarded = [];
    protected $fillable = ['order_status', 'tanggal', 'total_harga', 'id_meja', 'id_user'];


    public function meja()
    {
        return $this->belongsTo(Meja::class, 'id_meja');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'id_order');
    }
}
