<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 250);
            $table->timestamps();
        });

        $regions = [
            ['id' => 1, 'nom' => 'Diana'],
            ['id' => 2, 'nom' => 'Sava'],
            ['id' => 3, 'nom' => 'Itasy'],
            ['id' => 4, 'nom' => 'Analamanga'],
            ['id' => 5, 'nom' => 'Vakinankaratra'],
            ['id' => 6, 'nom' => 'Bongolava'],
            ['id' => 7, 'nom' => 'Sofia'],
            ['id' => 8, 'nom' => 'Boeny'],
            ['id' => 9, 'nom' => 'Betsiboka'],
            ['id' => 10, 'nom' => 'Melaky'],
            ['id' => 11, 'nom' => 'Alaotra-Mangoro'],
            ['id' => 12, 'nom' => 'Atsinanana'],
            ['id' => 13, 'nom' => 'Analanjirofo'],
            ['id' => 14, 'nom' => 'Amoron i Mania'],
            ['id' => 15, 'nom' => 'Haute Matsiatra'],
            ['id' => 16, 'nom' => 'Vatovavy'],
            ['id' => 17, 'nom' => 'Fitovinany'],
            ['id' => 18, 'nom' => 'Atsimo-Atsinanana'],
            ['id' => 19, 'nom' => 'Ihorombe'],
            ['id' => 20, 'nom' => 'Menabe'],
            ['id' => 21, 'nom' => 'Atsimo-Andrefana'],
            ['id' => 22, 'nom' => 'Androy'],
            ['id' => 23, 'nom' => 'Anôsy'],
        ];

        // Insertion des données dans la table regions
        DB::table('regions')->insert($regions);

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
