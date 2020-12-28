<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model {
    use HasFactory;

    protected $table = "cart";
    protected $fillable = [
        "product_id",
        "user_id",
        "quantity"
    ];

    /**
     * Indicate that the Cart model belongs to a certain user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    /**
     * Indicate that the Cart model belongs has certain product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() {
        return $this->belongsTo(Products::class, "product_id", "id");
    }
}
