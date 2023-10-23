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
        Schema::create('groupe_travails', function (Blueprint $table) {
            $table->id(); 
            $table->string('slug')->unique();
            $table->unsignedBigInteger('id_user');
            $table->string('titre')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('status');
            $table->boolean('active_commentaire');
            $table->text('entreprise')->nullable();
            $table->string('image')->nullable();
            $table->string('file_fr')->nullable();
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
        Schema::dropIfExists('groupe_travails');
    }
};
