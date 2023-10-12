<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('id_user');
            $table->string('titre');
            $table->text('description');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->boolean('status');
            $table->boolean('active_commentaire');
            $table->text('tags');
            $table->string('image');
            $table->string('file_fr')->nullable();
            $table->string('image_an')->nullable();
            $table->string('file_pr')->nullable();
            $table->timestamps();


            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
