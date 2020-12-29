<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_files', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('files_id');
            $table->unsignedBigInteger('categories_id');
            $table->timestamps();

            $table->primary(['files_id', 'categories_id']);

            $table->foreign('files_id')->references('id')->on('files');
            $table->foreign('categories_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_files');
    }
}
