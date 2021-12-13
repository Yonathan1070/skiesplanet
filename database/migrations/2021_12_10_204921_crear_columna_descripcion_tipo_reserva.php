<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaDescripcionTipoReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Tipo_Reserva', function (Blueprint $table) {
            $table->text('TTR_Descripcion_Tipo_Reserva')->after('TTR_Nombre_Tipo_Reserva');
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
            $table->dropColumn(['TTR_Descripcion_Tipo_Reserva']);
        });
    }
}
