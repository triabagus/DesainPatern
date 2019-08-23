<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BlogSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker      = Faker::create('id_ID');

        for($i=1; $i <=5 ; $i++){

            DB::table('blog_posts')->insert([
                'title'        => $faker->jobTitle,
                'author'       => $faker->name,
                'content'      => $faker->text,
                'created_at'   => now()
            ]);

        }
    }
}
