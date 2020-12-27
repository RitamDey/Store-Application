<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistModel extends Model {
    use HasFactory;

    protected $attributes = [
        "id",
        "description",
        "user_id",
        "created_at",
        "updated_at"
    ];
    protected $guarded = [
        "id",
        "created_at",
        "updated_at"
    ];
    protected $fillable = [
        "description",
        "user_id"
    ];
}
