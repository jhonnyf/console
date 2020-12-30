<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoins extends Migration
{
    
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->integer('active')->default(1);            
            $table->string('coin', 50);
            $table->string('symbol', 50);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
