<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesCategoriesSeeder extends Seeder
{

    public function run()
    {
        DB::table('categories_categories')->insert([
            'primary_id'   => 1,
            'secondary_id' => 2,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories_categories')->insert([
            'primary_id'   => 1,
            'secondary_id' => 3,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories_categories')->insert([
            'primary_id'   => 2,
            'secondary_id' => 4,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories_categories')->insert([
            'primary_id'   => 2,
            'secondary_id' => 5,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        DB::table('categories_categories')->insert([
            'primary_id'   => 2,
            'secondary_id' => 6,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);
    }
}
