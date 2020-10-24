<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTypesSeeder::class,
            UsersSeeder::class,
            CategoriesSeeder::class,
            CategoriesCategoriesSeeder::class
        ]);
    }
}
