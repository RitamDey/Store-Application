<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\StoreController;
use \App\Http\Controllers\BillController;
use \App\Http\Controllers\WishlistController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [StoreController::class, 'index'])->name("store.index");
Route::prefix("/prodcuts")->group(function() {
    Route::get("/new", [StoreController::class, 'new_products'])->name("store.new_products");
    Route::get('/{id}', [StoreController::class, 'show'])->name("store.product")->whereNumber("id");
});
Route::middleware("auth")->prefix("/user")->group(function() {
    Route::get("/my-cart", [StoreController::class, "cart_view"])->name("user.cart");
    Route::get("/checkout", [StoreController::class, "checkout_view"])
         ->middleware("password.confirm")->name("user.checkout");
    Route::post("/checkout", [StoreController::class, "checkout_make"])
         ->middleware("password.confirm")->name("user.checkout");
    Route::get('/dashboard', [BillController::class, "index"])->name('user.dashboard');
    Route::get("/bill/{id}", [BillController::class, "details"])->name('user.bill')->whereNumber("id");
});
Route::middleware("auth")->prefix("/wishlist")->group(function() {
    Route::get("/", [WishlistController::class, "show"])->name("wishlist.index");
    Route::get("/{id}", [WishlistController::class, "get"])->name("wishlist.details")->whereNumber("id");
});

Route::redirect("/dashboard", "/user/dashboard", 302);

require __DIR__.'/auth.php';
