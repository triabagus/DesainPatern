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
        
        
        // DB::table('users')->insert([
        //     'name'          => 'tria',
        //     'email'         => 'triatop9@gmail.com',
        //     'password'      => bcrypt('tria'),
        //     'is_admin'      => 0
        //     ]);
        // DB::table('users')->insert([
        //     'name'          => 'Admin Tria',
        //     'email'         => 'admin@gmail.com',
        //     'password'      => bcrypt('admin'),
        //     'is_admin'      => 1
        //     ]);
        DB::table('users')->insert([
            'name'          => 'Guest',
            'email'         => 'guest@gmail.com',
            'password'      => bcrypt('guest'),
            'is_admin'      => 2
            ]);
    }
}
