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
        Schema::create('supportformations_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id_supportformation');
            $table->unsignedBigInteger('id_category');

            $table->foreign('id_supportformation')->references('id')->on('supportformations')->onDelete('cascade');
            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');

              // Définition de la clé primaire composée
              $table->primary(['id_supportformation', 'id_category']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supportformations_categories');
    }
};
