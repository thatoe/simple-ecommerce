<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','price','category_id','image'];

    public function productcategory()
    {
        return $this->belongsTo(ProductCategories::class,'category_id','id');
    }

    public function cartitems()
    {
        return $this->hasMany(CartItems::class,'id','product_id');
    }
}
