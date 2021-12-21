<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsBuy extends Model
{
    use HasFactory;

    protected $fillable= ['details', 'iva', 'subtotal', 'quantity'];

    public function order(){
        return $this->belongsTo('App\Models\OrderBuy');
    }

    public function products(){
        return $this->belongsToMany('App\Models\Product')->withTimestamps();
    }
}
