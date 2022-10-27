<?php

namespace App\Models;

use App\Models\order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notify extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(order::class, 'order_id','id');
    }
}
