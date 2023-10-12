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
        Schema::create('thematiques', function (Blueprint $table) {
            $table->id();
            $table->text('thematique');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('active_commentaire')->default(true);
            $table->text('tags');
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
        Schema::dropIfExists('thematiques');
    }
};
