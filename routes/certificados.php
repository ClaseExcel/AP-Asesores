<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    //Agenda
    Route::resource('generar-certificados', GenerarCetificadosController::class)->names('generar-certificados');
    Route::post('generar-certificados/getDocumento', [GenerarCetificadosController::class, 'generarDocumento'])->name('generar-certificados.getDocumento');
    Route::post('generar-certificados/getEmpleado', [GenerarCetificadosController::class, 'getEmpleado'])->name('generar-certificados.getEmpleado');
});
