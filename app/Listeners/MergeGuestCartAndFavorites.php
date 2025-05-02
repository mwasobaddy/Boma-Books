<?php

namespace App\Listeners;

use App\Services\CartService;
use App\Services\FavoriteService;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cookie;

class MergeGuestCartAndFavorites
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected CartService $cartService,
        protected FavoriteService $favoriteService
    ) {}

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        // Merge cart items
        $cartSessionId = Cookie::get('boma_cart_session');
        if ($cartSessionId) {
            $this->cartService->mergeGuestCart($cartSessionId, $user->id);
        }

        // Merge favorites
        $favoriteSessionId = Cookie::get('boma_favorite_session');
        if ($favoriteSessionId) {
            $this->favoriteService->mergeGuestFavorites($favoriteSessionId, $user->id);
        }
    }
}