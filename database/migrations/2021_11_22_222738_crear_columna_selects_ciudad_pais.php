<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaSelectsCiudadPais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Tipo_Reserva', function (Blueprint $table) {
            $table->boolean('TTR_Select_Pais_Tipo_Reserva')->after('TTR_Costo_Tipo_Reserva');
            $table->boolean('TTR_Select_Ciudad_Tipo_Reserva')->after('TTR_Select_Pais_Tipo_Reserva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Tipo_Reserva', function (Blueprint $table) {
            $table->dropColumn(['TTR_Select_Pais_Tipo_Reserva']);
            $table->dropColumn(['TTR_Select_Ciudad_Tipo_Reserva']);
        });
    }
}
