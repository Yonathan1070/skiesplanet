<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaTraducciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Traduccion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('TTD_Tabla_Traduccion');
            $table->text('TTD_Campo_Traduccion');
            $table->unsignedBigInteger('TTD_Id_Traduccion');
            $table->string('TTD_Idioma_Traduccion', 5);
            $table->text('TTD_Descripcion_Traduccion');
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
        Schema::dropIfExists('TBL_Traduccion');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
