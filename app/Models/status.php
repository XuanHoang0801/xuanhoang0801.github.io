<?php

namespace App\Models;


use App\Models\order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class status extends Model
{
    use HasFactory;
    public function orders()
    {
        return $this->hasMany(order::class);
    }
}
