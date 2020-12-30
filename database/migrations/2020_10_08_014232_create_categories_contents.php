<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesContents extends Migration
{

    public function up()
    {
        Schema::create('links_categories_contents', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('categories_id');
            $table->unsignedBigInteger('contents_id');
            $table->timestamps();

            $table->primary(['categories_id', 'contents_id']);

            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('contents_id')->references('id')->on('contents');
        });
    }

    public function down()
    {
        Schema::dropIfExists('links_categories_contents');
    }
}
