<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->longText('usuario_camaracomercio')->nullable();
            $table->longText('usuario_eps')->nullable();
            $table->longText('usuario_afp')->nullable();
            $table->longText('clave_afp')->nullable();
            $table->longText('usuario_pila')->nullable();
            $table->longText('clave_pila')->nullable();
            $table->text('documento_camaracomercio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            //
        });
    }
};
