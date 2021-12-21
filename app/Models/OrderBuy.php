<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderBuy extends Model
{
    use HasFactory;

    protected $fillable =['address', 'status'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->user_id = Auth::id();
        });
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function details(){
        return $this->hasMany('App\Models\DetailsBuy');
    }
}
