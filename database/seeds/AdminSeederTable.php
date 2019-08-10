<?php

use Illuminate\Database\Seeder;

class AdminSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name'          => 'Admin Tria',
            'email'         => 'admin@gmail.com',
            'password'      => bcrypt('admin')
        ]);
    }
}
