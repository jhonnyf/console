<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('primary_id');
            $table->unsignedBigInteger('secondary_id');
            $table->timestamps();

            $table->primary(['primary_id', 'secondary_id']);

            $table->foreign('primary_id')->references('id')->on('categories');
            $table->foreign('secondary_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_categories');
    }
}
