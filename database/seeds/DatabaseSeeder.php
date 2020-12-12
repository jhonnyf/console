<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            CategoriesCategoriesSeeder::class,
            CategoriesUsersSeeder::class,
        ]);

        DB::table('files_galleries')->insert([
            'file_gallery' => 'Principal',
            'module'       => '',
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        DB::table('files_galleries')->insert([
            'file_gallery' => 'Perfil',
            'module'       => 'users',
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);
    }
}
