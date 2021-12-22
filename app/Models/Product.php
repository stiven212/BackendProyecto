<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'color', 'price' , 'sale', 'category_id'];

    public function car(){
        return $this->belongsToMany('App\Models\Car')->withTimestamps();
    }

    public function wishlist(){
        return $this->belongsToMany('App\Models\WishList')->withTimestamps();
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function detail(){
        return $this->belongsToMany('App\Models\BuyDetail')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
