<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('email');
            $table->string('password');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');

            $table->unsignedBigInteger('poste_id')->nullable();

            $table->foreign('poste_id')->references('id')->on('postes');

            $table->unsignedBigInteger('direction_id')->nullable();
            $table->foreign('direction_id')->references('id')->on('directions');
            $table->string('status');
            // $table->timestamp('created_at')->nullable();;
            // $table->timestamp('updated_at')->nullable();;
            // $table->foreignId('role_id')->constrained()->nullable();
            // $table->foreignId('poste_id')->constrained()->nullable();
            // $table->foreignId('direction_id')->constrained()->nullable();
        });

        DB::table('administrateurs')->insert([
                ['nom' => 'Rakoto','prenom' =>'Nandrianina','email' => 'superadmin@gmail.com','password' => Hash::make('1234567'),'role_id'=>1,
                'poste_id'=>2,'direction_id'=>1,'status' => 'Active' ],
                
            ]
        );
        DB::table('administrateurs')->insert([
                ['nom' => 'Rasoa','prenom' =>'Nomena','email' => 'service1@gmail.com','password' => Hash::make('12345'),'role_id'=>1,'poste_id'=>2,'direction_id'=>1,'status' => 'Desactive' ],
            ]
        );
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrateurs');
    }
}
