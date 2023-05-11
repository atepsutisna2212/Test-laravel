<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'tokoweb@gmail.com',
            'password' => bcrypt('tokoweb'),
        ]);

        DB::table('tb_category_product')->insert([
            'name' => 'web application',
        ]);

        DB::table('tb_product')->insert([
            'category_id' => 1,
            'price' => 2000000,
            'name' => 'aplikasi inventory',
            'image' => 'default.jpg',
        ]);
    }
}
