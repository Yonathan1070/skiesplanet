<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnaTraducciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Pais', function (Blueprint $table) {
            $table->string('TPA_Nombre_Pais_Espanol', 250)->after('TPA_Nombre_Pais');
            $table->dropColumn(['TPA_Nombre_Pais']);
            $table->string('TPA_Nombre_Pais_Ingles', 250)->after('TPA_Nombre_Pais_Espanol');
            $table->string('TPA_ISO_2', 2)->after('TPA_ISO_3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Pais', function (Blueprint $table) {
            $table->dropColumn(['TPA_Nombre_Pais_Espanol']);
            $table->string('TPA_Nombre_Pais', 250)->after('id');
            $table->dropColumn(['TPA_Nombre_Pais_Ingles']);
            $table->dropColumn(['TPA_ISO_2']);
        });
    }
}
