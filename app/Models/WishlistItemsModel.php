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
    public $timestamps = false;


    /**
     * Denotes the relation b/w WishlistItems model and Wishlist model
     * Using this method, a caller can get the wishlist to which this entry belongs
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function wishlist() {
        return $this->belongsTo(WishlistModel::class, "wishlist_id", "id");
    }
}
