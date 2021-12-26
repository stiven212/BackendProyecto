<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyDetail extends Model
{
    use HasFactory;

    protected $fillable= ['details', 'iva', 'subtotal', 'quantity', 'received', 'order_buy_id', 'total'];

    public function order(){
        return $this->belongsTo('App\Models\OrderBuy');
    }

    public function products(){
        return $this->belongsToMany('App\Models\Product')->withTimestamps();
    }
}
