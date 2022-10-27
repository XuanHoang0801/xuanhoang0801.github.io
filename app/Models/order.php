<?php

namespace App\Models;

use App\Models\card;
use App\Models\User;
use App\Models\Notify;
use App\Models\status;
use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order extends Model
{
    use HasFactory;
    public function cards()
    {
        return $this->belongsTo(card::class,'card_id','id');
    }

    public function statuses()
    {
        # code...
        return $this->belongsTo(status::class,'status_id','id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function products()
    {
        return $this->belongsTo(product::class,'product_id','id');
    }
    public function notify()
    {
       return $this->hasMany(Notify::class);
    }
}
