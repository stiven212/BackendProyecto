<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsBuy extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo('App\Models\OrderBuy');
    }

    public function products(){
        return $this->belongsToMany('App\Models\Products')->withTimestamps();
    }
}
