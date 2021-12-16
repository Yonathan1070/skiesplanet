<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearColumnasTblPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TBL_Pago', function (Blueprint $table) {
            $table->text('TPG_Cupon_Descuento_Pago')->after('TPG_Total_Pago');
            $table->unsignedBigInteger('TPG_Total_Descuento_Pago')->after('TPG_Cupon_Descuento_Pago');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TBL_Pago', function (Blueprint $table) {
            $table->dropColumn(['TPG_Cupon_Descuento_Pago', 'TPG_Total_Descuento_Pago']);
        });
    }
}
