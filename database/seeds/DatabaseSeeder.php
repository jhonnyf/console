<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            LanguagesSeeder::class,
            CategoriesSeeder::class,
            CategoriesUsersSeeder::class,            
            FilesGalleriesSeeder::class,
        ]);
    }
}
