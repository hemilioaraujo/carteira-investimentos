<?php

use App\Http\Controllers\AtivoController;
use App\Http\Controllers\CorretoraController;
use App\Http\Controllers\TipoOrdemController;
use App\Http\Controllers\TransacaoController;
use Illuminate\Support\Facades\Route;

Route::prefix('/ativos')->name('ativos.')->group(function () {
    Route::get('', [AtivoController::class, 'index'])->name('index');
    Route::post('', [AtivoController::class, 'store'])->name('store');
    Route::get('/{ativo}', [AtivoController::class, 'show'])->name('show');
    Route::put('/{ativo}', [AtivoController::class, 'update'])->name('update');
    Route::delete('/{ativo}', [AtivoController::class, 'destroy'])->name('destroy');
});

Route::apiResource('corretoras', CorretoraController::class);
Route::apiResource('tiposOrdens', TipoOrdemController::class);
Route::apiResource('transacoes', TransacaoController::class);
