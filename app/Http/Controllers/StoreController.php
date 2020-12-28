<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Bill;
use App\Models\BillItems;
use App\Models\CartModel;
use Illuminate\Support\Facades\Auth;
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
     * Helper function to get every item from a user's cart, prepare necessary info and create a collection
     * @return \array
    **/
    private function get_cart() {
        $cart_items = Auth::user()->cart_items;
        $cart_info = collect();
        $total = 0.0;

        foreach ($cart_items as $cart_item) {
            $product = collect([
                "id" => $cart_item->product_id,
                "name" => $cart_item->product->name,
                "price" => $cart_item->product->price,
                "quantity" => $cart_item->quantity,
                "item_total" => $cart_item->quantity * $cart_item->product->price
            ]);
            $cart_info->push($product);
            $total += $product->get('item_total');
        }

        return [ "products" => $cart_info, "total" => $total ];
    }

    /**
     * Helper functions to check if the cart is empty or nor
    **/
    private function cart_empty() {
        $user = Auth::user()->id;
        $cart_count = CartModel::where("user_id", $user)->count();

        return $cart_count < 1;
    }

    /**
     * Display the current users cart
     * @return \Illuminate\Contracts\View\View|Redirect
     */
    public function cart_view() {
        // Check if the cart is empty or not. If it's empty then show a empty cart screen
        if ($this->cart_empty())
            return view("store.empty_cart");
        
        return view("store.cart", $this->get_cart());
    }

    /**
     * Handle the checkout GET request. Shows all the products the user would place a order for
     * @return \Illuminate\Contracts\View\View|Redirect
     */
    public function checkout_view() {
        // Check if the cart is empty or not. If it's empty then show a empty cart screen
        if ($this->cart_empty())
            return view("store.empty_cart");

        return view("store.checkout", $this->get_cart());
    }

    /**
     * Handle the checkout POST request. Handles the creation of bill and shows the confirmation page
     * @return \Illuminate\Contracts\View\View|Redirect
     */
    public function checkout_make() {
        // Fetch the user model
        $user = Auth::user();
        // Create a entry for the new bill. We do this because we will need the id to add bill items
        $bill = Bill::create([ "user" => $user->id ]);
        $cart_items = $user->cart_items;
        $total_items = 0;
        $total_cost = 0.0;

        /**
         * Iterate over each cart items, get their product id, their required quanitity
         * Once fetched, create and save a bill item with the the bill_id set to the current bill
         * After this, update the running count of items purchased and the total cost of the bill
        **/
        foreach ($cart_items as $cart_item) {
            $bill_item = BillItems::create([
                "bill_id" => $bill->id,
                "product_id" => $cart_item->product_id,
                "quantity" => $cart_item->quantity
            ]);
            $total_items += $cart_item->quantity;
            $total_cost += $cart_item->quantity * $cart_item->product->price;
        }

        // We've everything in place, update the field in the model and save it in DB
        $bill->total_cost = $total_cost;
        $bill->total_items = $total_items;
        $bill->save();

        // Now delete the entire cart of the user and show the order placed message
        CartModel::where("user_id", $user->id)->delete();

        return view("store.order_placed", [ "order_id" => $bill->id ]);
    }
}
