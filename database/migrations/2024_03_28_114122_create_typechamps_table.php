<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypechampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typechamps', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("type");
            $table->timestamps();
        });

        $types=[
            ['id' => 1, 'nom' => 'texte','type' => 'text'],
            ['id' => 2, 'nom' => 'image','type' => 'image'],
            ['id' => 3, 'nom' => 'fichier','type' => 'file'],
            ['id' => 4, 'nom' => 'nombre','type' => 'number'],


        ];

        DB::table('typechamps')->insert($types);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typechamps');
    }
}
