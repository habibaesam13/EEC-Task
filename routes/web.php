<?php

use App\Http\Controllers\MVC\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::prefix('products')->group(function(){
    Route::get('/index',[ProductController::class,'index'])->name('products');
});
