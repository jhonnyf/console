<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{

    public function run()
    {
        DB::table('languages')->insert([
            'language'   => 'Português',
            'default'    => true,
            'code'       => 'pt-BR',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('languages')->insert([
            'language'   => 'Inglês',
            'default'    => false,
            'code'       => 'en',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
