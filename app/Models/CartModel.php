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
    protected $primaryKey = ["product_id", "user_id"];
}
