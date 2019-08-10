<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductCategoriesTableSeeders extends Seeder
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
            DB::table('product_categories')->insert([
                'name_categories'      => $faker->jobTitle
            ]);
        }
    }
}
