<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acces_offres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offre_id');
            $table->unsignedBigInteger('administrateur_id');
            $table->string('etat', 200);
            $table->timestamps();

            $table->foreign('offre_id')->references('id')->on('offres');
            $table->foreign('administrateur_id')->references('id')->on('administrateurs');

            $table->index('offre_id');
            $table->index('administrateur_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acces_offres');
    }
}
