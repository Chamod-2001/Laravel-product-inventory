<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\ProductController;
// Route::resource create CRUD auto and connect Product contorller calss
Route::resource('products', ProductController::class);
// Product trash page - only show soft deledted product
Route::get('products/trash', [ProductController::class, 'trash'])->name('products.trash');
// Restore for trash page - soft deleted product
Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
