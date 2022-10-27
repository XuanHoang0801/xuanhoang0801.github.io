<?php

namespace App\Models;

use App\Models\card;
use App\Models\Post;
use GuzzleHttp\Pool;
use App\Models\order;
use App\Models\Comment;
use App\Models\product;
use App\Models\Wishlist;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function products()
    {
        return $this->hasMany(product::class);
    }
    public function card()
    {
        return $this->hasMany(card::class);
    }
    public function orders()
    {
        return $this->hasMany(order::class);
    }
    public function Wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
}
