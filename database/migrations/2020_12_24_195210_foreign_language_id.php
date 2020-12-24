<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignLanguageId extends Migration
{

    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints('language_id');
    }
}
