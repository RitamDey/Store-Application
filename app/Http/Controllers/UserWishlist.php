<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWishlist extends Controller {
    public function index() {
        $user = Auth::user();

        return view("store.wishlist", [ "wishlists" => $user->wishlists ]);
    }
}