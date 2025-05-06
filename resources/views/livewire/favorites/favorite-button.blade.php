<?php

use App\Services\FavoriteService;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    public $favoritesCount = 0;
    
    public function mount()
    {
        $this->updateFavoritesCount();
    }
    
    public function updateFavoritesCount()
    {
        $favoriteService = app(FavoriteService::class);
        $this->favoritesCount = $favoriteService->getFavoritesCount();
    }
    
    #[On('favorites-updated')]
    public function handleFavoritesUpdated()
    {
        $this->updateFavoritesCount();
    }
}; ?>

<a href="{{ route('favorites.index') }}" class="relative p-2 mr-4 text-gray-600 hover:text-orange-600 dark:text-gray-400 dark:hover:text-orange-500 transition duration-150 ease-in-out group" wire:navigate>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
    </svg>
    @if($favoritesCount > 0)
        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-orange-600 rounded-full">{{ $favoritesCount }}</span>
    @endif
    <span class="hidden group-hover:block absolute top-10 right-0 bg-white dark:bg-gray-700 rounded-md shadow-lg text-sm py-1 px-2 whitespace-nowrap">
        Favorites
    </span>
</a>