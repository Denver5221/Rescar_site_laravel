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
        Schema::create('membre_morales', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('nom');
            $table->string('domaine');
            $table->string('pays');
            $table->boolean('légalisée');
            $table->integer('nombre_personnel');
            $table->string('nom_contact'); ////// Nom de la personne de contact
            $table->string('prenom_contact'); ////  Prénom de la personne de contact
            $table->string('fonction_contact'); ////  Fonction de la personne de contact
            $table->string('phone_contact'); //// Numéro de la personne de contact
            $table->string('email'); /////
            $table->longText('Biographie')->nullable();
            $table->string('fichier')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membre_morales');
    }
};
