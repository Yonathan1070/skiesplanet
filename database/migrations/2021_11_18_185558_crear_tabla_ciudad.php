<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCiudad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Ciudad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('TCI_Nombre_Ciudad', 250);
            $table->unsignedBigInteger('TCI_Pais_Id');
            $table->foreign('TCI_Pais_Id', 'FK_Ciudad_Pais')->references('id')->on('TBL_Pais')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Schema::dropIfExists('TBL_Ciudad');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
