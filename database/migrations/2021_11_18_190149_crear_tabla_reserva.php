<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Reserva', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('TRE_Tipo_Reserva_Id', 250);
            $table->unsignedBigInteger('TRE_Pais_Id')->nullable();
            $table->unsignedBigInteger('TRE_Ciudad_Id')->nullable();
            $table->string('TRE_Fecha_Reserva', 15);
            $table->text('TRE_Hora_Reserva');
            $table->unsignedBigInteger('TRE_Cliente_Id');
            $table->foreign('TRE_Cliente_Id', 'FK_Reserva_Cliente')->references('id')->on('TBL_Usuario')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('TRE_Titular_Id');
            $table->foreign('TRE_Titular_Id', 'FK_Reserva_Titular')->references('id')->on('TBL_Usuario')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('TBL_Reserva');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
