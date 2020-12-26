<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartModelSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('cart')->insert([
            "user_id" => 1,
            "product_id" => 1,
        ]);
    }
}
