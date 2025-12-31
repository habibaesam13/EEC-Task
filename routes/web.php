<?php

use App\Http\Controllers\MVC\PharmacyController;
use App\Http\Controllers\MVC\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('dashboard');

Route::prefix('products')->group(function(){
    Route::get('/',[ProductController::class,'index'])->name('products');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.delete');
});

Route::prefix('pharmacies')->group(function(){
    Route::get('/',[PharmacyController::class,'index'])->name('pharmacies');
    Route::get('/create', [PharmacyController::class, 'create'])->name('pharmacies.create');
    Route::post('/store', [PharmacyController::class, 'store'])->name('pharmacies.store');
    Route::get('/{pharmacy}', [PharmacyController::class, 'show'])->name('pharmacies.show');
    Route::get('/{pharmacy}/edit', [PharmacyController::class, 'edit'])->name('pharmacies.edit');
    Route::put('/{pharmacy}', [PharmacyController::class, 'update'])->name('pharmacies.update');
    Route::delete('/{pharmacy}', [PharmacyController::class, 'destroy'])->name('pharmacies.delete');
});
