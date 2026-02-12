<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\ProductController;
// Route::resource create CRUD auto and connect Product contorller calss
Route::resource('products', ProductController::class);
