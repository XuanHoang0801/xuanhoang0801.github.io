<?php

namespace App\Models;

use App\Models\product;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class producer extends Model
{
    use HasFactory;
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
    public function products()
    {
        return $this->hasMany(product::class);
    }
}
