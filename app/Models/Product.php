<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'color', 'price' , 'sale'];

    public function car(){
        return $this->belongsTo('App\Models\Car');
    }

    public function wishlist(){
        return $this->belongsTo('App\Models\WishList');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function detail(){
        return $this->belongsTo('App\Models\DetailsBuy');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
