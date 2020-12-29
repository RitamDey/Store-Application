<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\WishlistModel;
use Illuminate\Support\Facades\Log;

class MakeDefaultWishlist {

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event) {
        $user = $event->user->id;

        $default = WishlistModel::create([
            "user_id" => $user,
            "name" => "default",
            "description" => "Save your items to buy later"
        ]);

        $wishlist = $default->id;

        Log::debug("Created default wishlist ($wishlist) for user $user");
    }
}
