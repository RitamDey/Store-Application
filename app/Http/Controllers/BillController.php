<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Bill;
use App\Models\BillItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;


class BillController extends Controller {
    public function index(Request $request) {
        $user = Auth::user();

        return view("dashboard", [ "bills" => $user->bills ]);
    }

    public function details(int $bill_id) {
        $current_user = Auth::user()->id;

        // Make sure that the bill that is requested belongs to the user first
        $bill = Bill::where("id", $bill_id)->where("user", $current_user)->first();
        if ($bill === null) {
            return abort(404);
        } else {
            $bill_items = $bill->items;
            $bill_info = collect();

            foreach ($bill_items as $bill_item) {
                $product = collect([
                    "id" => $bill_item->product_id,
                    "name" => $bill_item->product->name,
                    "price" => $bill_item->product->price,
                    "quantity" => $bill_item->quantity,
                    "item_total" => $bill_item->quantity * $bill_item->product->price
                ]);
                $bill_info->push($product);
            }
            return view("store.bill_view", [ 
                "items" => $bill_info, "total" => $bill->total_cost, "total_items" => $bill->total_items
            ]);
        }
    }
}
