<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->integer('active')->default(1);
            $table->unsignedBigInteger('language_id')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->unsignedBigInteger('categories_id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('language_id')->on('languages')->references('id')->cascadeOnDelete();
            $table->foreign('reference_id')->on('contents_categories')->references('id')->cascadeOnDelete();
            $table->foreign('categories_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents_categories');
    }
}
