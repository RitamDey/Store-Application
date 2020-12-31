<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartModelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->prefix("/wishlist")->group(function() {
    Route::get("/get", [WishlistController::class, "index"])->name("user.wishlists");
});


Route::middleware('auth')->prefix("/cart")->group(function() {
    Route::post("/add", [CartModelController::class, "create"])->name("cart.add");
    Route::post("/remove", [CartModelController::class, "remove"])->name("cart.remove");
    Route::post("/increase", [CartModelController::class, "increase"])->name("cart.increase");
    Route::post("/decrease", [CartModelController::class, "decrease"])->name("cart.decrease");
});