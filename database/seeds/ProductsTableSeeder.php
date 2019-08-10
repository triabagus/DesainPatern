<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Faker::create('id_ID');

        for($i=1;$i<=5;$i++){
            DB::table('products')->insert([
                'name_product'      => $faker->company,
                'stock'             => $faker->numberBetween($min = 0, $max = 100) ,
                'price'             => $faker->numberBetween($min = 10000, $max = 100000) ,
                'image_product'     => 'default.png',
            ]);
        }

    }
}
