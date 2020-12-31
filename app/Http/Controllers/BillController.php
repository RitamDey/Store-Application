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
        $bill = Bill::find($bill_id)->where("user", $current_user);
        if ($bill === null) {

        } else {
            $items = $bill->first()->items;
            return $items->toArray();
        }
    }
}
