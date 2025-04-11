<?php

use App\Http\Controllers\AtivoController;
use App\Http\Controllers\CorretoraController;
use Illuminate\Support\Facades\Route;

Route::apiResource('ativos', AtivoController::class);
Route::apiResource('corretoras', CorretoraController::class);
