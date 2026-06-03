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
        Schema::table('gestion_humana', function (Blueprint $table) {
            $table->text('certificado_retiro_arl')->nullable();
            $table->text('certificado_retiro_caja')->nullable();
            $table->text('liquidacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gestion_humana_eventos', function (Blueprint $table) {
            //
        });
    }
};
