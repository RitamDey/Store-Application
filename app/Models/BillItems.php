<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillItems extends Model {
    use HasFactory;

    protected $table = "bill_items";
    protected $fillable = [
        "bill_id",
        "product_id",
        "quantity"
    ];
    public $timestamps = false;

    /**
     * Denotes the relation b/w BillItem model and Bill model
     * Using this method, a caller can get the bill to which it belongs
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function bill() {
        return $this->belongsTo(Bill::class, "bill_id", "id");
    }

    /**
     * Denotes the relation b/w Products model and Bill model
     * Using this method, a caller can get the product linked with this bill item
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/
    public function product() {
        return $this->belongsTo(Products::class, "product_id", "id");
    }
}
