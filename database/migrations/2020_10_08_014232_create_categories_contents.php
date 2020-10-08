<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_contents', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('content_id');
            $table->timestamps();

            $table->primary(['category_id', 'content_id']);

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('content_id')->references('id')->on('contents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_contents');
    }
}
