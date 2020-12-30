<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistModel extends Model {
    use HasFactory;

    protected $guarded = [
        "id",
        "created_at",
        "updated_at"
    ];
    protected $fillable = [
        "name",
        "description",
        "user_id",
        "default"
    ];
    protected $attributes = [
        "default" => false
    ];
    protected $table = "wishlist";
    protected $primaryKey = "id";

    /**
     * Indicate that the Wishlist model belongs to a certain user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    /**
     * Fetch the items in a particular wishlist
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function items() {
        return $this->hasMany(WishlistItemsModel::class, "wishlist_id");
    }
}
