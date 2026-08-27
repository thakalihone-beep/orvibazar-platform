<?php

use App\Http\Controllers\Frontend\Authcontroller;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\WishlistController;

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

// web.php - Add cart routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/checkout/now', [CheckoutController::class, 'now'])->name('checkout.now');



// Wishlist Routes
Route::prefix('wishlist')->name('wishlist.')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/toggle', [WishlistController::class, 'toggle'])->name('toggle');
    Route::post('/add/{productId}', [WishlistController::class, 'add'])->name('add');
    Route::delete('/remove/{productId}', [WishlistController::class, 'remove'])->name('remove');
    Route::delete('/clear', [WishlistController::class, 'clear'])->name('clear');
    Route::get('/count', [WishlistController::class, 'getCount'])->name('count');
});

//login
Route::get('/login',[Authcontroller::class, 'login'])->name('login');
Route::get('/register',[Authcontroller::class, 'register'])->name('register');
Route::post('/logout', [Authcontroller::class, 'logout'])->name('logout');

