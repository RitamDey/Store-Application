<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;

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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/products", function (Request $request) {
    return \App\Models\Products::all()->toJson();
});


Route::middleware('auth')->prefix("/wishlist")->group(function() {
    Route::get("/get", [WishlistController::class, "index"])->name("user.wishlists");
});