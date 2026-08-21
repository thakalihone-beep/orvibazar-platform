<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RegisterController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/option', [RegisterController::class, 'option'])->name('option');
Route::get('/vendor-regestration', [RegisterController::class, 'vendor'])->name('vendor');
Route::get('/customer-regestration', [RegisterController::class, 'customer'])->name('customer');
Route::get('/term-service', [RegisterController::class, 'service'])->name('terms.service');
Route::get('/privacy-policy', [RegisterController::class, 'policy'])->name('privacy.policy');
Route::get('/vendor-agreement', [RegisterController::class, 'agreement'])->name('vendor.agreement');
Route::post('/vendor-regestration', [RegisterController::class, 'store'])->name('vendor.store');
