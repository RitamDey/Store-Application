<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistModel extends Model {
    use HasFactory;

    protected $primaryKey = "wishlist_id";
    protected $fillable = [
        "wishlist_id",
        "product_id"
    ];
    protected $guarded = [
        "added_at"
    ];
    protected $attributes = [
        "wishlist_id",
        "product_id",
        "added_at"
    ];

    const CREATED_AT = "added_at";
}
