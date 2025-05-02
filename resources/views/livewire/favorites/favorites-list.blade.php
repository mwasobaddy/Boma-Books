<?php

use App\Services\FavoriteService;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $favorites = [];
    public $emptyFavoritesMessage = 'Your favorites list is empty.';
    
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
            $favoriteService->removeFromFavorites($book);
            $this->loadFavorites();
            $this->dispatch('favorites-updated');
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
    </div>
    
    @if(count($favorites) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($favorites as $favorite)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden flex flex-col h-full">
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
                        <a href="{{ route('shop.show', $favorite->book->id) }}" class="text-lg font-semibold text-gray-900 dark:text-white hover:text-orange-600 dark:hover:text-orange-400 transition-colors">
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
            <a href="{{ route('shop.index') }}" class="py-2 px-4 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-md transition-colors inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Browse Books
            </a>
        </div>
    @endif
</div>