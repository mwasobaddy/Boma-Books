<?php

use App\Models\Book;
use App\Services\CartService;
use App\Services\FavoriteService;
use Livewire\Volt\Component;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\PreserveScroll;
use Livewire\Attributes\On;

new #[PreserveScroll] class extends Component {
    public Book $book;
    public int $quantity = 1;
    public bool $inCart = false;
    public bool $inFavorites = false;
    public string $buttonStyle = 'primary'; // primary or secondary
    public bool $showQuantity = true;
    public bool $processing = false;
    public ?string $message = null;
    
    public function mount(Book $book, string $buttonStyle = 'primary', bool $showQuantity = true)
    {
        $this->book = $book;
        $this->buttonStyle = $buttonStyle;
        $this->showQuantity = $showQuantity;
        $cartService = app(CartService::class);
        $cartItem = $cartService->getCartItems()->first(fn($item) => $item->book->id === $this->book->id);
        $this->inCart = (bool) $cartItem;
        if ($cartItem) {
            $this->quantity = $cartItem->quantity;
        }
        
        // Check if book is in favorites (for both guests and authenticated users)
        $favoriteService = app(FavoriteService::class);
        $this->inFavorites = $favoriteService->isInFavorites($this->book);
    }

    public function increaseQuantity()
    {
        $this->quantity++;
        $cartService = app(\App\Services\CartService::class);
        $cartItem = $cartService->getCartItems()->first(fn($item) => $item->book->id === $this->book->id);
        if ($cartItem) {
            $cartService->updateCartItemQuantity($cartItem->id, $this->quantity);
            $this->dispatch('cart-updated');
            
            // Show toast notification for quantity update
            $this->dispatch('showToast', 
                icon: 'success', 
                title: 'Quantity updated to ' . $this->quantity,
                timer: 2000
            );
        }
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $cartService = app(\App\Services\CartService::class);
            $cartItem = $cartService->getCartItems()->first(fn($item) => $item->book->id === $this->book->id);
            if ($cartItem) {
                $cartService->updateCartItemQuantity($cartItem->id, $this->quantity);
                $this->dispatch('cart-updated');
                
                // Show toast notification for quantity update
                $this->dispatch('showToast', 
                    icon: 'info', 
                    title: 'Quantity updated to ' . $this->quantity,
                    timer: 2000
                );
            }
        }
    }
    
    public function addToCart()
    {
        $this->processing = true;
        
        try {
            $cartService = app(CartService::class);
            if ($this->inCart) {
                // remove from cart
                $item = $cartService->getCartItems()->first(fn($i) => $i->book->id === $this->book->id);
                if ($item) {
                    $cartService->removeFromCart($item->id);
                    $this->inCart = false;
                    
                    // Show toast notification for removed item
                    $this->dispatch('showToast', 
                        icon: 'success', 
                        title: 'Removed from Cart!',
                        text: $this->book->title . ' has been removed from your cart.',
                        timer: 3500
                    );
                }
            } else {
                // add to cart
                $cartService->addToCart($this->book, $this->quantity);
                $this->inCart = true;
                
                // Show toast notification for added item
                $this->dispatch('showToast', 
                    icon: 'success', 
                    title: 'Added to Cart!', 
                    text: $this->quantity . ' × ' . $this->book->title . ' has been added to your cart.',
                    timer: 4500
                );
            }
            $this->dispatch('cart-updated');
        } catch (\Exception $e) {
            // Show error alert 
            $this->dispatch('showAlert', 
                icon: 'error', 
                title: 'Oops!',
                text: $this->inCart ? 'Failed to remove from cart.' : 'Failed to add to cart.'
            );
        } finally {
            $this->processing = false;
        }
    }
    
    public function toggleFavorite()
    {
        try {
            $favoriteService = app(FavoriteService::class);
            
            if ($this->inFavorites) {
                // Remove from favorites
                $favoriteService->removeFromFavorites($this->book);
                $this->inFavorites = false;
                
                // Show toast notification
                $this->dispatch('showToast', 
                    icon: 'success', 
                    title: 'Removed from Favorites',
                    text: $this->book->title . ' has been removed from your favorites.',
                    timer: 3000
                );
            } else {
                // Add to favorites
                $favoriteService->addToFavorites($this->book);
                $this->inFavorites = true;
                
                // Show toast notification
                $this->dispatch('showToast', 
                    icon: 'success', 
                    title: 'Added to Favorites!',
                    text: $this->book->title . ' has been added to your favorites.',
                    timer: 3000
                );
            }
            
            // Broadcast the event to all components
            $this->dispatch('favorites-updated');
            
        } catch (\Exception $e) {
            // Show error alert
            $this->dispatch('showAlert', 
                icon: 'error', 
                title: 'Oops!',
                text: 'Failed to update favorites. Please try again.'
            );
        }
    }
    
    #[On('cart-updated')]
    public function handleCartUpdated()
    {
        $this->inCart = app(CartService::class)->getCartItems()->contains(fn($item) => $item->book->id === $this->book->id);
    }
    
    #[On('favorites-updated')]
    public function handleFavoritesUpdated()
    {
        $favoriteService = app(FavoriteService::class);
        $this->inFavorites = $favoriteService->isInFavorites($this->book);
    }
}; ?>

<div class="flex flex-col gap-3">
    @if($showQuantity && $inCart)
        <div class="flex items-center mt-2">
            <label for="quantity-{{ $book->id }}" class="mr-3 text-sm font-medium text-gray-700 dark:text-gray-300">Quantity:</label>
            <div class="flex items-center">
                <button 
                    type="button" 
                    wire:click="decreaseQuantity"
                    wire:loading.attr="disabled"
                    class="border border-orange-500 dark:border-orange-500 bg-white dark:bg-gray-700 text-orange-500 rounded-l-md p-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 disabled:opacity-50"
                    @if($quantity <= 1 || $processing) disabled @endif
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </button>
                <input 
                    type="number" 
                    id="quantity-{{ $book->id }}" 
                    wire:model.live="quantity" 
                    readonly
                    class="dark:bg-gray-700 dark:text-white py-2 pl-1 w-12 text-center focus:outline-none"
                >
                <button 
                    type="button" 
                    wire:click="increaseQuantity"
                    wire:loading.attr="disabled"
                    class="border border-orange-500 dark:border-orange-500 bg-white dark:bg-gray-700 text-orange-500 rounded-r-md p-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 disabled:opacity-50"
                    @if($processing) disabled @endif
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="flex gap-2">
        <!-- View Button -->
        <a 
            href="{{ route('shop.show', $book->id) }}"
            class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 dark:bg-blue-700 hover:bg-blue-600 dark:hover:bg-blue-800 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            wire:navigate
            wire:loading.attr="disabled"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            View
        </a>

        <!-- Favorite Button -->
        <button 
            wire:click="toggleFavorite"
            wire:key="favorite-{{ $book->id }}"
            class="flex-1 inline-flex justify-center items-center px-4 py-2 border text-sm font-medium rounded-md shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500
                {{ $inFavorites 
                    ? 'border-pink-500 text-pink-700 dark:text-pink-300 bg-pink-50 dark:bg-pink-900/20 hover:bg-pink-100 dark:hover:bg-pink-900/30' 
                    : 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="{{ $inFavorites ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            {{ $inFavorites ? 'Saved' : 'Save' }}
        </button>
    </div>

    <!-- Add to Cart Button -->
    <button 
        wire:click="addToCart"
        wire:loading.class="opacity-75" 
        wire:loading.attr="disabled"
        wire:target="addToCart"
        wire:key="add-to-cart-{{ $book->id }}"
        @if($processing) disabled @endif
        class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white transition-colors disabled:opacity-50 
            {{ $inCart ? 'bg-red-600 hover:bg-red-700 focus:ring-red-500' : 'bg-orange-600 hover:bg-orange-700 focus:ring-orange-500' }}"
    >
        <div wire:loading wire:target="addToCart" class="mr-2">
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        {{ $inCart ? 'Remove from Cart' : 'Add to Cart' }}
    </button>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('showAlert', (params) => {
                Swal.fire({
                    icon: params.icon,
                    title: params.title,
                    text: params.text,
                    imageUrl: params.imageUrl || null,
                    imageWidth: params.imageWidth || null,
                    imageHeight: params.imageHeight || null,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            });
            
            @this.on('showToast', (params) => {
                Toast.fire({
                    icon: params.icon,
                    title: params.title,
                    text: params.text || null,
                    timer: params.timer || 3000,
                    timerProgressBar: true
                });
            });
        });
    </script>
</div>