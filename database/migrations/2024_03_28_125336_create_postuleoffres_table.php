<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostuleoffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postuleoffres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offre_id');
            $table->longText('detailsEnqueteurs');
            $table->timestamp('datepostule')->nullable();
            $table->unsignedBigInteger('enqueteur_id');
            $table->string('typeEnqueteurs', 250);
            $table->timestamps();

            $table->foreign('offre_id')->references('id')->on('offres');
            $table->foreign('enqueteur_id')->references('id')->on('enqueteurs');

            $table->index('enqueteur_id');
            $table->index('offre_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postuleoffres');
    }
}
