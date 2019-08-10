<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    protected $fillable = [
        'name_categories'
    ];

    public function CategoriesProduct(){
        return $this->hasMany('App\Models\ProductCategories');
    }
}
