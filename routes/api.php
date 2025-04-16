<?php

use App\Http\Controllers\AtivoController;
use App\Http\Controllers\CorretoraController;
use App\Http\Controllers\TipoOrdemController;
use App\Http\Controllers\TransacaoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('ativos', AtivoController::class);
Route::apiResource('corretoras', CorretoraController::class);
Route::apiResource('tiposOrdens', TipoOrdemController::class);
Route::apiResource('transacoes', TransacaoController::class);
