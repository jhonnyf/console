<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksProductsFiles extends Migration
{

    public function up()
    {
        Schema::create('links_products_files', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('files_id');
            $table->unsignedBigInteger('products_id');
            $table->timestamps();

            $table->primary(['files_id', 'products_id']);

            $table->foreign('files_id')->references('id')->on('files');
            $table->foreign('products_id')->references('id')->on('products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('links_products_files');
    }
}
