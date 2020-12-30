<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesUsers extends Migration
{

    public function up()
    {
        Schema::create('links_categories_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('categories_id');
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->primary(['categories_id', 'users_id']);

            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('links_categories_users');
    }
}
