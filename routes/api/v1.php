<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/categories', [CategoryController::class, 'index'])->name('api.v1.categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('api.v1.categories.show');
Route::post('/categories', [CategoryController::class, 'store'])->name('api.v1.categories.store');

