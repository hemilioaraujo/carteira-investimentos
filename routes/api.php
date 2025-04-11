<?php

use App\Http\Controllers\AtivoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('ativos', AtivoController::class);
