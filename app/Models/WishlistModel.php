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
        "user_id"
    ];
    protected $table = "wishlist";
    protected $primaryKey = "id";

}
