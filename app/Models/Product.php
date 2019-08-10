<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_product', 'stock', 'price', 'image_product','categories_id'
    ];

    public function Product () {
        return $this->belongTo('App\Models\Product');
    }
}
