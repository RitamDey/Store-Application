<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Denotes the One-To-Many relationship b/w Cart model and a User.
     * This function allows the caller to fetch the entire user cart in one call
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart_items(): HasMany {
        return $this->hasMany(CartModel::class, "user_id");
    }

    /**
     * Denotes the One-To-Many relationship b/w Bill model and a User
     * This function allows the caller to fetch the entire bills in one call
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills(): HasMany {
        return $this->hasMany(Bill::class, "user");
    }

    /**
     * Denotes the One-To-Many relationship b/w Wishlist model and a User
     * This function allows the caller to fetch the entire wishlists in one call
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlists(): HasMany {
        return $this->hasMany(WishlistModel::class, "user_id");
    }
}
