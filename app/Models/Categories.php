<?php

namespace App\Models;

use App\Models\nsx;
use App\Models\Post;
use App\Models\product;
use App\Models\producer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;
    public function producers(){
        return $this->hasMany(producer::class);
    }
    public function products()
    {
        return $this->hasManyThrough([product::class, producer::class], 'categories_id','producer_id', 'id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function nsx()
    {
        return $this->hasMany(nsx::class);
    }
}
