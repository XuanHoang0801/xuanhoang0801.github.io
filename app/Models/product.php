<?php

namespace App\Models;

use App\Models\nsx;
use App\Models\card;
use App\Models\User;
use App\Models\Comment;
use App\Models\producer;
use App\Models\Wishlist;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory, SoftDeletes;
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
    public function nsx()
    {
        return $this->belongsTo(nsx::class,'producer_id','id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function card()
    {
        return $this->belongsTo(card::class);
    }

    public function orders()
    {
        return $this->hasMany(order::class);
    }
    public function Wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    
}
