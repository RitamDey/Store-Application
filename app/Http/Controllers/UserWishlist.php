<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WishlistModel;

class UserWishlist extends Controller {
    public function index() {
        $user = Auth::user();

        return view("store.wishlist", [ "wishlists" => $user->wishlists ]);
    }

    public function create() {
    }

    public function get(int $id) {
        $user = Auth::user()->id;

        $wishlist = WishlistModel::where("user_id", $user)->where("id", $id)->first();

        return view("store.wishlist_details", [ "items" => $wishlist->items ]);
    }
}