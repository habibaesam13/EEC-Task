<?php

use App\Http\Controllers\Api\PharmacyController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function(){
    Route::get('/index',[ProductController::class,'index']);
    Route::post('/store',[ProductController::class,'store']);
    Route::get('/show/{product}',[ProductController::class,'show']);
    Route::delete('/delete/{product}',[ProductController::class,'destroy']);
    Route::put('/update/{product}',[ProductController::class,'update']);
});

Route::prefix('pharmacies')->group(function(){
    Route::get('/index',[PharmacyController::class,'index']);
    Route::post('/store',[PharmacyController::class,'store']);
    Route::get('/show/{pharmacy}',[PharmacyController::class,'show']);
    Route::delete('/delete/{pharmacy}',[PharmacyController::class,'destroy']);
    Route::put('/update/{pharmacy}',[PharmacyController::class,'update']);
});