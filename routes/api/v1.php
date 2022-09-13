<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('api.v1.categories.index');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('api.v1.categories.show');
    Route::post('/', [CategoryController::class, 'store'])->name('api.v1.categories.store');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('api.v1.categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('api.v1.categories.destroy');
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('api.v1.products.index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('api.v1.products.show');
    Route::post('/', [ProductController::class, 'store'])->name('api.v1.products.store');
    Route::put('/{product}', [ProductController::class, 'update'])->name('api.v1.products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('api.v1.products.destroy');
});