<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesLinksUsers extends Migration
{

    public function up()
    {
        Schema::create('files_links_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('secondary_id');
            $table->timestamps();

            $table->primary(['file_id', 'secondary_id']);

            $table->foreign('file_id')->references('id')->on('files');
            $table->foreign('secondary_id')->references('id')->on('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('files_links_users');
    }
}
