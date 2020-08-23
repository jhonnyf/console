<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'user_type_id' => '1',
            'name'         => 'Root',
            'email'        => 'root@seven.com',
            'password'     => Hash::make('123123'),
            'document'     => '',
            'phone'        => '',
            'cellphone'    => '',
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);
    }
}
