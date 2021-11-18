<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('TUS_Nombre_Completo_Usuario', 250);
            $table->string('TUS_Correo_Electronico_Usuario', 500);
            $table->string('TUS_Telefono_Usuario', 20);
            $table->unsignedBigInteger('TUS_Rol_Id');
            $table->foreign('TUS_Rol_Id', 'FK_Usuario_Rol')->references('id')->on('TBL_Rol')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('TBL_Usuario');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
