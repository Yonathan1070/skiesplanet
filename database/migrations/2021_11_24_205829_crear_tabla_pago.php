<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Pago', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('TPG_Reserva_Id');
            $table->foreign('TPG_Reserva_Id', 'FK_Pago_Reserva')->references('id')->on('TBL_Reserva')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('TPG_Total_Pago');
            $table->string('TPG_Fecha_Pago', 50);
            $table->text('TPG_Estado_Pago');
            $table->string('TPG_Idioma_Pago', 100);
            $table->text('TPG_Referencia_Pago');
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
        Schema::dropIfExists('TBL_Pago');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
