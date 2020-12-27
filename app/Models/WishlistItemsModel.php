<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItemsModel extends Model {
    use HasFactory;

    const CREATED_AT = "added_at";

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
    public $timestamps = false;
}
