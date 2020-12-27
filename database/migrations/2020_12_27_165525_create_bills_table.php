<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user");
            $table->double("total_cost")->default(0);
            $table->integer("total_items")->default(0);
            $table->timestamp("created_at")->useCurrent();

            $table->foreign("user")->references("id")->on("users")
                  ->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::create('bill_items', function (Blueprint $table) {
            $table->unsignedBigInteger("bill_id");
            $table->unsignedBigInteger("product_id");
            $table->smallInteger("quantity");

            $table->foreign("bill_id")->references("id")->on("bills")
                  ->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('bills');
        Schema::dropIfExists('bill_items');
    }
}
