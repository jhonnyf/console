<?php

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $response = Users::create([
            'first_name' => 'Root',
            'last_name'  => 'Seventh',
            'email'      => 'root@seven.com',
            'password'   => Hash::make('123123'),
            'document'   => '',
        ]);

        Users::find($response->id)->categories()->attach(4);
    }
}
