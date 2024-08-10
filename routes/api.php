<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Routes
Route::post('/login', [AuthController::class, 'login']);

// Private Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth', [AuthController::class, 'auth']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('/users', UserController::class);
});
