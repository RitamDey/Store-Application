<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultFlag extends Migration {
    /**
     * Add the "default" column in the table. When set to true, the wishlist is treated as default
     */


    public function up() {
        Schema::table('wishlist', function (Blueprint $table) {
            $table->boolean("default")->nullable(false)->default(false);
        });
    }

    public function down() {
        Schema::table('wishlist', function (Blueprint $table) {
            $table->dropColumn("default");
        });
    }
}
