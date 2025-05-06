<?php

use App\Services\FavoriteService;
use App\Services\CartService;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $favorites = [];
    public $emptyFavoritesMessage = 'Your favorites list is empty.';
    public $isProcessing = false;
    
    public function mount()
    {
        $this->loadFavorites();
    }
    
    public function loadFavorites()
    {
        $favoriteService = app(FavoriteService::class);
        $this->favorites = $favoriteService->getFavorites();
    }
    
    public function removeFromFavorites($bookId)
    {
        $favoriteService = app(FavoriteService::class);
        $book = \App\Models\Book::find($bookId);
        
        if ($book) {
            // Remove from favorites
            $favoriteService->removeFromFavorites($book);
            
            // Remove from local array without full reload for better UX
            $this->favorites = $this->favorites->reject(function($favorite) use ($bookId) {
                return $favorite->book->id == $bookId;
            });
            
            // Dispatch event for counter update
            $this->dispatch('favorites-updated');
            
            // Show toast notification
            $this->dispatch('showToast', 
                icon: 'success', 
                title: 'Removed from Favorites',
                text: $book->title . ' has been removed from your favorites.',
                timer: 2000
            );
        }
    }
    
    public function removeAllFavorites()
    {
        $favoriteService = app(FavoriteService::class);
        $count = count($this->favorites);
        
        if ($count > 0) {
            // Clear all favorites
            $favoriteService->clearFavorites();
            $this->favorites = collect(); // Empty the collection
            
            // Dispatch event for counter update
            $this->dispatch('favorites-updated');
            
            // Show toast notification
            $this->dispatch('showToast', 
                icon: 'success', 
                title: 'All Favorites Removed',
                text: $count . ' ' . ($count == 1 ? 'item' : 'items') . ' removed from your favorites.',
                timer: 3000
            );
        }
    }
    
    public function addAllToCart()
    {
        if ($this->isProcessing || $this->favorites->isEmpty()) {
            return;
        }
        
        $this->isProcessing = true;
        
        try {
            $cartService = app(CartService::class);
            $addedCount = 0;
            
            foreach ($this->favorites as $favorite) {
                if ($favorite->book->stock > 0) {
                    $cartService->addToCart($favorite->book, 1);
                    $addedCount++;
                }
            }
            
            // Dispatch event for cart counter update
            $this->dispatch('cart-updated');
            
            // Show success notification
            if ($addedCount > 0) {
                $this->dispatch('showToast', 
                    icon: 'success', 
                    title: 'Added to Cart!',
                    text: $addedCount . ' ' . ($addedCount == 1 ? 'book' : 'books') . ' added to your cart.',
                    timer: 3000
                );
            } else {
                $this->dispatch('showAlert', 
                    icon: 'warning', 
                    title: 'No Books Added',
                    text: 'All of your favorite books are currently out of stock.'
                );
            }
        } catch (\Exception $e) {
            // Show error alert
            $this->dispatch('showAlert', 
                icon: 'error', 
                title: 'Oops!',
                text: 'Failed to add books to cart. Please try again.'
            );
        } finally {
            $this->isProcessing = false;
        }
    }
    
    #[On('favorites-updated')]
    public function handleFavoritesUpdated()
    {
        $this->loadFavorites();
    }
}; ?>

<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">My Favorites</h1>
        
        @if(count($favorites) > 0)
            <div class="flex gap-3">
                <button 
                    wire:click="addAllToCart"
                    wire:loading.class="opacity-75" 
                    wire:loading.attr="disabled"
                    wire:target="addAllToCart"
                    class="py-2 px-4 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-md transition-colors inline-flex items-center gap-2 disabled:opacity-50"
                    @if($isProcessing) disabled @endif
                >
                    <div wire:loading wire:target="addAllToCart" class="mr-1">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Add All to Cart
                </button>
                
                <button 
                    wire:click="removeAllFavorites"
                    wire:loading.class="opacity-75" 
                    wire:loading.attr="disabled"
                    wire:target="removeAllFavorites"
                    class="py-2 px-4 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 font-medium rounded-md transition-colors inline-flex items-center gap-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Clear All
                </button>
            </div>
        @endif
    </div>
    
    @if(count($favorites) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($favorites as $favorite)
                <div wire:key="favorite-{{ $favorite->book->id }}" class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden flex flex-col h-full">
                    <div class="relative h-56 bg-gray-100 dark:bg-gray-700">
                        @if($favorite->book->cover_image)
                            <img src="{{ asset('storage/' . $favorite->book->cover_image) }}" alt="{{ $favorite->book->title }}" class="w-full h-full object-cover object-center">
                        @else
                            <div class="flex items-center justify-center w-full h-full bg-gray-200 dark:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif
                        
                        <button 
                            wire:click="removeFromFavorites({{ $favorite->book->id }})"
                            class="absolute top-2 right-2 rounded-full bg-white dark:bg-gray-700 p-2 text-red-500 shadow hover:text-red-600 hover:shadow-md transition-all"
                            title="Remove from favorites"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="p-4 flex-grow flex flex-col">
                        <a href="{{ route('shop.show', $favorite->book->id) }}" class="text-lg font-semibold text-gray-900 dark:text-white hover:text-orange-600 dark:hover:text-orange-400 transition-colors" wire:navigate>
                            {{ $favorite->book->title }}
                        </a>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            By {{ $favorite->book->author }}
                        </p>
                        <div class="mt-auto pt-4 flex items-center justify-between">
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $favorite->book->formatted_price }}
                            </span>
                            <livewire:cart.add-to-cart :key="'add-to-cart-fav-'.$favorite->book->id" :book="$favorite->book" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="py-12 flex flex-col items-center justify-center border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-lg">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-2">{{ $emptyFavoritesMessage }}</h2>
            <p class="text-gray-500 dark:text-gray-400 text-center mb-6">
                Add books to your favorites list to keep track of books you're interested in.
            </p>
            <a href="{{ route('shop.index') }}" class="py-2 px-4 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-md transition-colors inline-flex items-center gap-2" wire:navigate>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Browse Books
            </a>
        </div>
    @endif
    
    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('showAlert', (params) => {
                Swal.fire({
                    icon: params.icon,
                    title: params.title,
                    text: params.text,
                    timer: params.timer || 3000,
                    timerProgressBar: params.timer ? true : false,
                    showConfirmButton: params.showConfirmButton ?? false
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