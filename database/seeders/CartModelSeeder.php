<?php

namespace Database\Seeders;

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
            [
                "user_id" => 1,
                "product_id" => 1,
                "quantity" => 1
            ],
            [
                "user_id" => 1,
                "product_id" => 3,
                "quantity" => 2,
            ],
            [
                "user_id" => 2,
                "product_id" => 2,
                "quantity" => 1
            ],
            [
                "user_id" => 2,
                "product_id" => 4,
                "quantity" => 2
            ]
        ]);
    }
}
