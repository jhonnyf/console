<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LanguagesSeeder::class,
            CategoriesSeeder::class,
            UsersSeeder::class,
            FilesGalleriesSeeder::class,
            CoinsSeeder::class
        ]);
    }
}
