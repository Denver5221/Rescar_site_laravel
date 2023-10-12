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
        Schema::create('commentaire_forums', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_forum');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_forum')->references('id')->on('forums')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('commentaire_forums')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaire_forums');
    }
};
