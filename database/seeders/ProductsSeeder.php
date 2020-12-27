<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder {
    // Seed the database with fake data
    public function run() {
        DB::table('products')->insert([
            [
                'name' => "Product 1",
                'description' => "Our first ever product",
                'price' => 100,
                'created_at' => Carbon::yesterday("IST")
            ],
            [
                'name' => "Product 2",
                'description' => "Our second product",
                'price' => 150,
                'created_at' => Carbon::today("IST")
            ],
            [
                'name' => "Product 3",
                'description' => "Our latest innovation",
                'price' => 300,
                'created_at' => Carbon::tomorrow("IST")
            ],
            [
                'name' => "Product 4",
                'description' => "Because why not?",
                'price' => 200,
                'created_at' => Carbon::tomorrow("IST")->addDays(2)
            ]
        ]);
    }
}
