<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesUsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories_users')->insert([
            'category_id' => 4,
            'user_id'     => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
    }
}
