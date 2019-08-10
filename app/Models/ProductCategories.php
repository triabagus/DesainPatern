<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategories extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name_categories'
    ];

    public function CategoriesProduct(){
        return $this->hasMany('App\Models\ProductCategories');
    }
}
