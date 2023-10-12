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
        Schema::create('membres', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('id_user');
            $table->string('nom');
            $table->string('prenom');
            $table->unsignedBigInteger('id_post');
            $table->string('email');
            $table->integer('telephone');
            $table->string('facebook')->nullable()->unique();
            $table->string('linkedin')->nullable()->unique();
            $table->string('photo')->nullable();
            $table->string('cv')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_post')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membres');
    }
};
