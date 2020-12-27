<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cart', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->useCurrent();
            $table->smallInteger('quantity')->default(1);

            $table->foreign("user_id")->references('id')->on('users')
                  ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("product_id")->references("id")->on("products")
                  ->cascadeOnDelete()->cascadeOnUpdate();

            $table->primary(['product_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cart');
    }
}
