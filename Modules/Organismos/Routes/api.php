<?php

use Modules\Organismos\Http\Controllers\V1\OrganismosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function() {
    Route::prefix('organismos')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/', [OrganismosController::class, 'index'])->name('organismos.index');
            Route::get('/lista', [OrganismosController::class, 'getAll'])->name('organismos.getAll');
            Route::get('/{id}', [OrganismosController::class, 'show'])->name('organismos.show');
            Route::put('/{id}', [OrganismosController::class, 'update'])->name('organismos.update');
            Route::post('/', [OrganismosController::class, 'store'])->name('organismos.store');
            Route::put('/{id}/estado', [OrganismosController::class, 'editEstado'])->name('organismos.editEstado');
            Route::get('/{id}/carpetas', [OrganismosController::class, 'showFolders'])->name('organismos.carpetas');
        });
    });
});
