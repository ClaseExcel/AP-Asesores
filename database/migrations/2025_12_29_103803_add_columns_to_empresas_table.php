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
        Schema::table('empresas', function (Blueprint $table) {
            //
            $table->string('logocliente')->nullable()->default('default.jpg');
            $table->text('nombres_usuario_certificado')->nullable();
            $table->text('cargo_usuario_certificado')->nullable();
            $table->text('telefono_usuario_certificado')->nullable();
            $table->text('correo_usuario_certificado')->nullable();
            $table->text('firma_usuario_certificado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            //
        });
    }
};
