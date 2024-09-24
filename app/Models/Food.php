<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='foods';
    public function cart(){
        return $this->hasMany(cart::class);
    }
    public function order(){
        return $this->hasManyThrough(Order::class,cart::class);
    }
}
