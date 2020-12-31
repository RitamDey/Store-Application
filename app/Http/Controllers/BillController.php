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

    public function details(Request $request) {
    }
}
