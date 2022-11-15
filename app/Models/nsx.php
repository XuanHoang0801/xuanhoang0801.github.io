<?php

namespace App\Models;

use App\Models\product;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class nsx extends Model
{
    use HasFactory,SoftDeletes;
    protected $casts =[
        'categories_id' =>'array'
    ];
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'categories_id','id');
    }
    public function products()
    {
        return $this->hasMany(product::class);
    }
}
