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
        Schema::create('llamados_atencion', function (Blueprint $table) {
            $table->id();
            $table->text('asunto')->nullable();
            $table->text('medidas')->nullable();
            $table->text('consecutivo')->nullable();
            $table->text('evidencia')->nullable();
            $table->text('url_documento')->nullable();
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('llamado_atencions');
    }
};
