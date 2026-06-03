<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;


// rutas de clientes

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::post('empresas/municipio', [EmpresaController::class, 'municipio'])->name('municipios');
    Route::resource('empresas', EmpresaController::class)->names('empresas');
    Route::get('empresas/uvt/{anio?}', [EmpresaController::class, 'findUVT'])->name('empresas.uvt');
    Route::get('admin/empresas/export', [EmpresaController::class, 'empresasExport'])->name('empresas.export');
    Route::get('empresas/nit/{nit?}', [EmpresaController::class, 'findNit'])->name('empresas.nit');

});
