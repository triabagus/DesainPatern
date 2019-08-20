<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name_product' => $faker->name,
        'stock' => $faker->randomDigit,
        'price' => $faker->numberBetween($min=10000, $max=9999999),
        'image_product' => $faker->imageUrl($width=400, $height=400, 'cats'),
        'categories_id' => factory('App\Models\ProductCategories')->create()->id,
        'created_at' => now()
    ];
});