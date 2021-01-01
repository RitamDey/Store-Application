<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WishlistModel;
use App\Models\WishlistItemsModel;

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

        return view("store.wishlist_details", [ "items" => $wishlist->items ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
