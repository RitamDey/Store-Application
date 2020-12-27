<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class StoreController extends Controller {
    /**
     * Display a listing of the resource
     * @return \Illuminate\Contracts\View\View
     */
    public function index() {
        return view('store.index', [ "products" => Products::all() ]);
    }

    /**
     * Display the specified resource.
     * @param  int  $storeItems
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $storeItems) {
        Log::debug("Requested $storeItems");
        // Use the requested ID to find the product
        $item = Products::query()->find($storeItems);
        return view('store.details', [ "product" => $item ]);
    }

    /**
     * Display the newest products first
     * @return \Illuminate\Contracts\View\View
     */
    public function new_products() {
        $latest_five = Products::query()->orderByDesc('created_at')->get();
        return view('store.index', [ "products" => $latest_five ]);
    }

    /**
     * Display the current users cart
     * @return \Illuminate\Contracts\View\View|Redirect
     */
    public function cart_view() {
        $user_id = Auth::id();
        Log::debug("Fetching and rendering cart for $user_id");

        $query = DB::table("cart")->join($table="products", $first="products.id", "=", "cart.product_id")
            ->select(["user_id", "product_id", "name", "price", "quantity"])
            ->where("user_id", "=", $user_id)->get();

        $cost = $query->reduce(function ($sum, $element) {
            return $sum + ($element->price * $element->quantity);
        }, 0);


        return view("store.cart", ["products" => $query, "total" => $cost]);
    }
}
