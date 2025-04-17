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

Route::prefix('/corretoras')->name('corretoras.')->group(function () {
    Route::get('', [CorretoraController::class, 'index'])->name('index');
    Route::post('', [CorretoraController::class, 'store'])->name('store');
    Route::get('/{corretora}', [CorretoraController::class, 'show'])->name('show');
    Route::put('/{corretora}', [CorretoraController::class, 'update'])->name('update');
    Route::delete('/{corretora}', [CorretoraController::class, 'destroy'])->name('destroy');
});

Route::prefix('/tiposOrdens')->name('tipos-ordens.')->group(function () {
    Route::get('', [TipoOrdemController::class, 'index'])->name('index');
    Route::post('', [TipoOrdemController::class, 'store'])->name('store');
    Route::get('/{tipoOrdem}', [TipoOrdemController::class, 'show'])->name('show');
    Route::put('/{tipoOrdem}', [TipoOrdemController::class, 'update'])->name('update');
    Route::delete('/{tipoOrdem}', [TipoOrdemController::class, 'destroy'])->name('destroy');
});

Route::prefix('/transacoes')->name('transacoes.')->group(function () {
    Route::get('', [TransacaoController::class, 'index'])->name('index');
    Route::post('', [TransacaoController::class, 'store'])->name('store');
    Route::get('/{transacao}', [TransacaoController::class, 'show'])->name('show');
    Route::put('/{transacao}', [TransacaoController::class, 'update'])->name('update');
    Route::delete('/{transacao}', [TransacaoController::class, 'destroy'])->name('destroy');
});
