<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'color', 'price' , 'sale'];

    public function car(){
        return $this->belongsToMany('App\Models\Car');
    }

    public function wishlist(){
        return $this->belongsToMany('App\Models\WishList')->withTimestamps();
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function detail(){
        return $this->belongsToMany('App\Models\DetailsBuy')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
