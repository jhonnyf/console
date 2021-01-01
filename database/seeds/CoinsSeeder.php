<?php

use App\Models\Coins;
use Illuminate\Database\Seeder;

class CoinsSeeder extends Seeder
{
   
    public function run()
    {
        Coins::create(['coin' => 'Real', 'symbol' => 'R$', 'default' => true]);
    }
}
