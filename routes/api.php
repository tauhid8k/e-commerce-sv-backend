<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\SelectOptionsController;
use App\Http\Controllers\Api\Admin\AdminUserController;
use App\Http\Controllers\Api\Admin\AdminBrandController;
use App\Http\Controllers\Api\Admin\AdminCategoryController;
use App\Http\Controllers\Api\Admin\AdminAttributeController;
use App\Http\Controllers\Api\Admin\AdminProductController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);

// Private Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth', [AuthController::class, 'auth'])->name('auth');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Select Options
    Route::get('/options/categories', [SelectOptionsController::class, 'getCategories']);
    Route::get('/options/brands', [SelectOptionsController::class, 'getBrands']);
    Route::get('/options/attributes', [SelectOptionsController::class, 'getAttributes']);
    Route::get('/options/attributes/{id}', [SelectOptionsController::class, 'getAttributeOptions']);

    Route::prefix('admin')->group(function () {
        Route::apiResource('/users', AdminUserController::class);
        Route::apiResource('/categories', AdminCategoryController::class);
        Route::apiResource('/attributes', AdminAttributeController::class);
        Route::apiResource('/brands', AdminBrandController::class);
        Route::apiResource('/products', AdminProductController::class);
    });
});
