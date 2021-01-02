<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Model;


class Products extends Model {
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $casts = [
        'price' => 'float'
    ];
    protected $guarded = [
        "id",
        "created_at",
        "updated_at"
    ];
    protected $fillable = [
        "name",
        "description",
        "price",
        "url"
    ];
}
