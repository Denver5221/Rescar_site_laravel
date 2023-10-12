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
        Schema::create('actualites_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id_actualite');
            $table->unsignedBigInteger('id_category');
            // Ajoutez d'autres colonnes si nécessaire

            // Définition des clés étrangères
            $table->foreign('id_actualite')->references('id')->on('actualites')->onDelete('cascade');
            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');

            // Définition de la clé primaire composée
            $table->primary(['id_actualite', 'id_category']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actualites_categories');
    }
};
