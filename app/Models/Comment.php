<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{

    public static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->user_id = Auth::id();
        });
    }
    protected $fillable = ['content'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
