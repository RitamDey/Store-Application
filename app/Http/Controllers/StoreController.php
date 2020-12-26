<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Support\Facades\Log;

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
        return view('product', [ "product" => $item ]);
    }

    /**
     * Display the newest products first
     * @return \Illuminate\Contracts\View\View
     */
    public function new_products() {
        $latest_five = Products::query()->orderByDesc('created_at')->get();
        return view('welcome', [ "products" => $latest_five ]);
    }
}
