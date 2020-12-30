<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartModelController extends Controller {
    
    private $validation = [
        "product" => "required|integer"
    ];

    public function create(Request $request) {
        $user = Auth::user()->id;
        $validated = $request->validate($this->validation);
        $product = intval($validated["product"]);
        Log::debug("Adding Product $product to User $user cart");

        $item = CartModel::create([
            "product_id" => $product,
            "user_id" => $user,
            "quantity" => 1
        ]);

        return [ "status" => true ];

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartModel  $cartModel
     * @return \Illuminate\Http\Response
     */
    public function show(CartModel $cartModel) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartModel  $cartModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartModel $cartModel) {
        //
    }

    /**
     * Remove the specified product from user's cart.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request) {
        $user = Auth::user()->id;
        $validated = $request->validate($this->validation);
        $product = intval($validated["product"]);

        $products = CartModel::where("product_id", $product)->where("user_id", $user)->get();
        
        $total = $products->reduce(function (int $sum, CartModel $item) {
            return $sum + ($item->quantity * $item->product->price);
        }, 0);
        
        $status = CartModel::where("product_id", $product)->where("user_id", $user)->delete();

        if ($status === 1) {
            Log::debug("Removed Product $product from User $user cart");
            return [ "status" => true, "cost" => $total ];
        }
        else {
            Log::debug("Error removing Product $product from User $user cart");
            return [ "status" => false ];
        }
    }
}
