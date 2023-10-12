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
        Schema::create('recrutement_partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('id_user');
            $table->string('nom');
            $table->text('description');
            $table->unsignedBigInteger('id_partenaire');
            $table->string('lien')->nullable();
            $table->string('file')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            // onDelete('cascade'): Cela supprimera automatiquement les enregistrements liés dans la table
            //  'partenaires' lorsque la référence est supprimée dans la table actuelle.
            $table->foreign('id_partenaire')->references('id')->on('partenaires')->onDelete('cascade');

            // // onDelete('set null'): Cela définira la valeur de la clé étrangère sur NULL dans les
            // enregistrements liés de la table actuelle lorsque la référence est supprimée dans la table
            // 'partenaires'.

            // $table->foreign('id_partenaire')->references('id')->on('partenaires')->onDelete('set null');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recrutement_partenaires');
    }
};
