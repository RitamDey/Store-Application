<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Auth\Events\Registered;


class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     * @return void
     */
    public function run() {
        $ritam = User::create([
            "name" => "Ritam Dey",
            "email" => "ritam@domain.com",
            "password" => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
        ]);
        event(new Registered($ritam));

        $tester = User::create([
            "name" => "Tester",
            "email" => "tester@domain.com",
            "password" => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
        ]);
        event(new Registered($tester));
    }
}
