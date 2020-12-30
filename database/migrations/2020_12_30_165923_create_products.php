<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->integer('active')->default(1);
            $table->integer('sku');
            $table->decimal('weight')->default(0);
            $table->decimal('width')->default(0);
            $table->decimal('height')->default(0);
            $table->decimal('length')->default(0);
            $table->integer('stock')->default(0);
            $table->string('combo_code')->nullable();
            $table->dateTime('release_date');
            $table->dateTime('expiration_date');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
