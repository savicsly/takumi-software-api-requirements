<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('api.v1.categories.index');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('api.v1.categories.show');
    Route::post('/', [CategoryController::class, 'store'])->name('api.v1.categories.store');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('api.v1.categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('api.v1.categories.destroy');
});