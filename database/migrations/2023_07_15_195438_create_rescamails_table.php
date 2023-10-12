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
        Schema::create('rescamails', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('id_user');
            $table->string('expediteur');
            $table->string('destinataire');
            $table->string('cc');
            $table->string('subject')->nullable();
            $table->string('fichier')->nullable();
            $table->longText('contenu');
            $table->boolean('lu')->default(false);
            $table->timestamps();


            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rescamails');
    }
};
