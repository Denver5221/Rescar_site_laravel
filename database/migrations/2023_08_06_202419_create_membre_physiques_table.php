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
        Schema::create('membre_physiques', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('nom');
            $table->string('prenom');
            $table->date('data_naissance');
            $table->string('pays');
            $table->string('sexe');
            $table->string('profil_academique');
            $table->string('domaine_specialisation');
            $table->string('fonction_actuelle');
            $table->string('phone');
            $table->string('email');
            $table->longText('Biographie');
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
        Schema::dropIfExists('membre_physiques');
    }
};
