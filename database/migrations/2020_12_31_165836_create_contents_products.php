<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsProducts extends Migration
{
  
    public function up()
    {
        Schema::create('contents_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->integer('active')->default(1);
            $table->unsignedBigInteger('language_id')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->unsignedBigInteger('products_id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('language_id')->on('languages')->references('id')->cascadeOnDelete();
            $table->foreign('reference_id')->on('contents_categories')->references('id')->cascadeOnDelete();
            $table->foreign('products_id')->references('id')->on('products')->cascadeOnDelete();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('contents_products');
    }
}
