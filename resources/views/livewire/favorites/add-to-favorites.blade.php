<?php

use App\Models\Book;
use App\Services\FavoriteService;
use Livewire\Volt\Component;

new class extends Component {
    public Book $book;
    public bool $isFavorited = false;
    public string $buttonStyle = 'icon'; // icon, primary, or secondary
    
    public function mount(Book $book, string $buttonStyle = 'icon')
    {
        $this->book = $book;
        $this->buttonStyle = $buttonStyle;
        $this->checkIfFavorited();
    }
    
    public function checkIfFavorited()
    {
        $favoriteService = app(FavoriteService::class);
        $this->isFavorited = $favoriteService->isInFavorites($this->book);
    }
    
    public function toggleFavorite()
    {
        $favoriteService = app(FavoriteService::class);
        
        if ($this->isFavorited) {
            $favoriteService->removeFromFavorites($this->book);
        } else {
            $favoriteService->addToFavorites($this->book);
        }
        
        $this->checkIfFavorited();
        $this->dispatch('favorites-updated');
    }
}; ?>

<div>
    @if($buttonStyle === 'icon')
        <!-- Heart icon button -->
        <button
            wire:click="toggleFavorite"
            class="rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-red-100 dark:hover:bg-red-900 hover:text-red-500 dark:hover:text-red-400 p-2 transition-colors focus:outline-none {{ $isFavorited ? 'bg-red-100 dark:bg-red-900 text-red-500 dark:text-red-400' : '' }}"
            title="{{ $isFavorited ? 'Remove from favorites' : 'Add to favorites' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="{{ $isFavorited ? '0' : '2' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button>
    @elseif($buttonStyle === 'primary')
        <!-- Primary button -->
        <button 
            wire:click="toggleFavorite"
            class="inline-flex items-center px-4 py-2 bg-{{ $isFavorited ? 'red' : 'gray' }}-600 hover:bg-{{ $isFavorited ? 'red' : 'gray' }}-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $isFavorited ? 'red' : 'gray' }}-500 transition-colors"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="{{ $isFavorited ? '0' : '2' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            {{ $isFavorited ? 'Remove from Favorites' : 'Add to Favorites' }}
        </button>
    @else
        <!-- Secondary button -->
        <button 
            wire:click="toggleFavorite"
            class="inline-flex items-center px-4 py-2 border border-{{ $isFavorited ? 'red' : 'gray' }}-300 text-{{ $isFavorited ? 'red' : 'gray' }}-700 dark:text-{{ $isFavorited ? 'red' : 'gray' }}-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $isFavorited ? 'red' : 'gray' }}-500 transition-colors"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="{{ $isFavorited ? '0' : '2' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            {{ $isFavorited ? 'Remove from Favorites' : 'Add to Favorites' }}
        </button>
    @endif
</div>