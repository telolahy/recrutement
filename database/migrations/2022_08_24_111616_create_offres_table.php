<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('nomEnquete');
            $table->text('detailsEnquete');
            $table->timestamp('dateDebut');
            $table->string('statusOffres');
            $table->timestamp('dateLimite')->nullable();
            $table->unsignedBigInteger('administrateur_id');
            $table->foreign('administrateur_id')->references('id')->on('administrateurs')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->text('formulaire');
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
        Schema::dropIfExists('offres');
    }
}
