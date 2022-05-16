<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItems extends Model
{
    // use HasFactory;
    protected $fillable = ['product_id'];

    public function product()
    {
        return $this->belongsTo(Products::class,'product_id','id');
    }
}
