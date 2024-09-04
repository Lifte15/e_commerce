<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect('/products');
// });

// Resource route for products
Route::get('/', [ProductController::class, 'index']) ->name('home');
Route::resource('products', ProductController::class);
Route::get('/helloworl', [ProductController::class, 'helloWorl'])->name('helloworl');
