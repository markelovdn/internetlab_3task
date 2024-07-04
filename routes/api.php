<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('/users', UserController::class)->only(['store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/users', UserController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
