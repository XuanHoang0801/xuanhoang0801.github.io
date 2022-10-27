<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsTo(product::class, 'product_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
