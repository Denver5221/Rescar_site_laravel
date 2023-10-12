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
        Schema::create('fiches_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id_fiche');
            $table->unsignedBigInteger('id_category');

            $table->foreign('id_fiche')->references('id')->on('fiches')->onDelete('cascade');
            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');

              // Définition de la clé primaire composée
              $table->primary(['id_fiche', 'id_category']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fiches_categories');
    }
};
