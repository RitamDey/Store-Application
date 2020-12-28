<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model {
    use HasFactory;

    protected $attributes = [
        "total_cost" => 0,
        "total_items" => 0,
    ];
    protected $guarded = [
        "id",
        "created_at"
    ];
    protected $fillable = [
        "user",
        "total_cost",
        "total_items"
    ];
    protected $primaryKey = "id";
    protected $table = "bills";
    public $timestamps = false;

    /**
     * Denotes the relationship b/w User model and the Bill model
     * Using this the caller can resolve to which user the bill belongs to
     * @return \App\Models\User
    */
    public function user() {
        return $this->belongsTo(User::class, "user");
    }

    /**
     * Denotes the relationship b/w Bill model and BillItems model
     * Using this the caller can get the items present in a particular bill
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    **/
    public function items() {
        return $this->hasMany(BillItems::class, "bill_id");
    }
}
