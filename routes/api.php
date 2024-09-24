<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\SelectOptionsController;
use App\Http\Controllers\Api\Shop\CategoryController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);

// Private Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth', [AuthController::class, 'auth'])->name('auth');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Select Options
    Route::get('/options/categories', [SelectOptionsController::class, 'getCategories']);

    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/users', UserController::class);
});
