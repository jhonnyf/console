<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            CategoriesCategoriesSeeder::class,
            CategoriesUsersSeeder::class,
            FilesGalleriesSeeder::class,
        ]);
    }
}
