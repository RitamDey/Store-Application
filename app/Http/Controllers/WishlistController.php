<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WishlistModel;
use App\Models\WishlistItemsModel;
use App\Models\CartModel;

class WishlistController extends Controller {
    public function index() {
        $user = Auth::user();

        /**
         * This method takes each of the avaliable wishlist model, extracts the id and name
         * And then creates a <option> element for the frontend
        **/
        $extract = function($item, $key) {
            $key = $item->id;
            $name = $item->name;
            if ($item->default)
                return "<option value=$key selected>$name</option>";
            else
                return "<option value=$key>$name</option>";
        };
        
        // Fetch all the wishlist, apply the function on everyone of them and then join them in a string
        return $user->wishlists->map($extract)->join("\n");
    }

    public function store(Request $request) {
        $validation = [
            "wishlist" => "required|numeric|exists:App\Models\WishlistModel,id",
            "item" => "required|numeric|exists:App\Models\Products,id"
        ];
        $validated = $request->validate($validation);
        $exists = WishlistItemsModel::where("wishlist_id", $validated["wishlist"])
                  ->where("product_id", $validated["item"])->exists();

        if ($exists) {
            return [ "status" => false, "message" => "Product already in wishlist" ];
        }

        $status = WishlistItemsModel::create([
            "wishlist_id" => $validated["wishlist"],
            "product_id" => $validated["item"]
        ]);
        
        return [ "status" => true ];
    }

    public function remove(Request $request) {
        $validation = [
            "wishlist" => "required|numeric|exists:App\Models\WishlistModel,id",
            "item" => "required|numeric|exists:App\Models\Products,id"
        ];
        $validated = $request->validate($validation);
        $status = WishlistItemsModel::where("wishlist_id", $validated["wishlist"])
                  ->where("product_id", $validated["item"])->delete();

        return [ "status" => $status === 1 ];
    }

    public function show() {
        $user = Auth::user();

        return view("store.wishlist", [ "wishlists" => $user->wishlists ]);
    }

    public function get(int $id) {
        $user = Auth::user()->id;
        $wishlist = WishlistModel::where("user_id", $user)->where("id", $id)->first();

        if ($wishlist === null)
            return abort(404);
        $items = $wishlist->items;

        if ($items->isEmpty())
            return view("store.empty_wishlist");

        return view("store.wishlist_details", [ "items" => $items, "wishlist" => $id ]);
    }

    public function update(Request $request) {
        $user = Auth::user()->id;

        $validation = [
            "item" => "required|numeric|exists:App\Models\Products,id"
        ];
        $validated = $request->validate($validation);
        $exists = CartModel::where("product_id", $validated["item"])
                           ->where("user_id", $user)->exists();
        if ($exists)
            return [ "status" => false, "message" => "Item already in cart"];

        $status = CartModel::create([
            "product_id" => $validated["item"],
            "user_id" => $user
        ]);

        if ($status === null)
            return [ "status" => false, "message" => "Database error. Can't add to cart"];

        return [ "status" => true ];
    }


    public function create(Request $request) {
        $user = Auth::user();
        $validation = [
            "name" => "required|string"
        ];
        $validated = $request->validate($validation);

        $exists = WishlistModel::where("user_id", $user->id)->where("name", $validated["name"])->exists();
        if ($exists) {
            return [ "status" => false, "message" => "Wishlist with same name already exists "];
        }
        $status = WishlistModel::create([
            "name" => $validated["name"],
            "user_id" => $user->id
        ]);

        return [ "status" => $status !== null, "name" => $status->name, "id" => $status->id ];
    }
}
