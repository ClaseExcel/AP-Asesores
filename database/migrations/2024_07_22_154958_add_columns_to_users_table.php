<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('barrio')->nullable();
            $table->date('fecha_nacimiento')->nullable();       
            $table->date('fecha_contrato')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_retiro')->nullable();
            $table->text('salario')->nullable();
            $table->text('tipo_contrato')->nullable();
            $table->text('EPS')->nullable();
            $table->text('caja_compensacion')->nullable();
            $table->text('fondo_pension')->nullable();
            $table->text('funeraria')->nullable();
            $table->text('nivel_riesgo')->nullable();
            $table->text('contrasena_eps')->nullable();
            $table->string('documento_examen')->nullable();
            $table->string('documento_afiliacion')->nullable();
            $table->string('documento_contrato')->nullable();
            $table->string('documento_otros')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
