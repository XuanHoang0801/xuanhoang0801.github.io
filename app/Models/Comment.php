<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    public function posts()
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }
    public function products()
    {
        return $this->belongsTo(product::class,'product_id','id');
    }
    
}
