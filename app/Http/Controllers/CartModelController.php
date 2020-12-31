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

    private function modify_cart(Request $request, int $by) {
        $user = Auth::user()->id;
        $validated = $request->validate($this->validation);
        $product = intval($validated["product"]);
        $item = CartModel::where("product_id", $product)->where("user_id", $user)->first();

        if ($item === null)
            return [ "status" => false ];

        $status = CartModel::where("product_id", $product)->where("user_id", $user)->update([
            "quantity" => $item->quantity + $by
        ]);

        if ($status === 1) {
            Log::debug("[User $user] Updated user cart quantity");
            return [ "status" => true, "price" => $item->product->price ];
        }
        
        return [ "status" => false ];
    }

    public function increase(Request $request) {
        return $this->modify_cart($request, 1);
    }

    public function decrease(Request $request) {
        return $this->modify_cart($request, -1);
    }

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
