<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RegisterController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');
Route::get('/products', [PageController::class, 'shop'])->name('products.index');
Route::get('/products/{slug}', [PageController::class, 'productShow'])->name('product.show');
Route::get('/categories', [PageController::class, 'categories'])->name('categories');
Route::get('/category/{slug}', [PageController::class, 'categoryShow'])->name('category.show');
Route::get('/sale', [PageController::class, 'sale'])->name('sale');

Route::get('/option', [RegisterController::class, 'option'])->name('option');
Route::get('/vendor-regestration', [RegisterController::class, 'vendor'])->name('vendor');
Route::get('/customer-regestration', [RegisterController::class, 'customer'])->name('customer');
Route::get('/term-service', [RegisterController::class, 'service'])->name('terms.service');
Route::get('/privacy-policy', [RegisterController::class, 'policy'])->name('privacy.policy');
Route::get('/vendor-agreement', [RegisterController::class, 'agreement'])->name('vendor.agreement');
Route::post('/vendor-regestration', [RegisterController::class, 'store'])->name('vendor.store');

