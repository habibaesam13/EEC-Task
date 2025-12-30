<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/products')->group(function(){
    Route::get('/index',[ProductController::class,'index']);
    Route::post('/store',[ProductController::class,'store']);
    Route::get('/show/{productId}',[ProductController::class,'show']);
    Route::delete('/delete/{productId}',[ProductController::class,'destroy']);
    
});