<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     * @return void
     */
    public function run() {
        DB::table("users")->insert([
            [
                "name" => "Ritam Dey",
                "email" => "ritam@domain.com",
                "email_verified_at" => null,
                "password" => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
                "remember_token" => null,
                "created_at" => Carbon::yesterday("IST"),
                "updated_at" => Carbon::today("IST")
            ],
            [
                "name" => "Tester",
                "email" => "tester@domain.com",
                "email_verified_at" => null,
                "password" => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
                "remember_token" => null,
                "created_at" => Carbon::yesterday("IST"),
                "updated_at" => Carbon::today("IST")
            ],
        ]);
    }
}
