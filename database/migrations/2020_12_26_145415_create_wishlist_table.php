<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistTable extends Migration {
    /**
     * Run the migrations.
     * @return void
     */
    public function up() {
        Schema::create('wishlist', function (Blueprint $table) {
            $table->id();
            $table->text("description");
            $table->unsignedBigInteger("user_id");
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->useCurrent()->useCurrentOnUpdate();

            $table->foreign("user_id")->references("id")->on("users")
                  ->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::create('wishlist_items', function (Blueprint $table) {
            $table->unsignedBigInteger("wishlist_id");
            $table->unsignedBigInteger("product_id");
            $table->timestamp("added_at")->useCurrent();

            $table->foreign("wishlist_id")->references("id")->on("wishlist")
                  ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign("product_id")->references("id")->on("products")
                  ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('wishlist');
        Schema::dropIfExists('wishlist_items');
    }
}
