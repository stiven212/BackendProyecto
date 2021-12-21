<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Car extends Model
{

    public static function boot()
    {
        parent::boot();
        static::creating(function ($car) {
            $car->user_id = Auth::id();
        });
    }
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Products')->withTimestamps();
    }


}
