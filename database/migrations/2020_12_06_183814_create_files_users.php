<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesUsers extends Migration
{

    public function up()
    {
        Schema::create('files_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('files_id');
            $table->unsignedBigInteger('users_id');
            $table->timestamps();

            $table->primary(['files_id', 'users_id']);

            $table->foreign('files_id')->references('id')->on('files');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('files_users');
    }
}
