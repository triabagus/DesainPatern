<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\ProductCategories;
use Faker\Generator as Faker;

$factory->define(ProductCategories::class, function (Faker $faker) {
    return [
        'name_categories' => $faker->word
    ];
});
