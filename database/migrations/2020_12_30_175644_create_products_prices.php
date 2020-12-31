<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsPrices extends Migration
{
 
    public function up()
    {
        Schema::create('products_prices', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->integer('active')->default(1);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('coin_id');
            $table->decimal('price')->default(0);
            $table->decimal('cost_price')->default(0);
            $table->decimal('final_price')->default(0);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->foreign('coin_id')->references('id')->on('coins')->cascadeOnDelete();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('products_prices');
    }
}
