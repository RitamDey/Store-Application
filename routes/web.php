<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\StoreController;
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
Route::get("/new-products", [StoreController::class, 'new_products'])->name("store.new_products");
Route::get('/product/{id}', [StoreController::class, 'show'])
     ->name("store.product")->whereNumber("id");
Route::get("/my-cart", [StoreController::class, "cart_view"])
     ->middleware("auth")->name("user.cart");
Route::get("/checkout", [StoreController::class, "checkout_view"])
     ->middleware("password.confirm")->name("user.checkout");
Route::post("/checkout", [StoreController::class, "checkout_make"])
     ->middleware("password.confirm")->name("user.checkout");

Route::get('/dashboard', function () {
    return view('dashboard', ["products" => [], "total_item" => 0]);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
