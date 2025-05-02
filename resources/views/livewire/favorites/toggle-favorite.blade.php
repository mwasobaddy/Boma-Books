<?php

use App\Models\Book;
use App\Services\FavoriteService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

new class extends Component {
    #[Reactive]
    public Book $book;
    
    public bool $loading = false;
    public bool $isFavorited = false;
    public ?string $successMessage = null;
    
    public function mount()
    {
        $this->checkIfFavorited();
    }
    
    #[Computed]
    public function requiresLogin()
    {
        return !Auth::check() && env('REQUIRE_LOGIN_TO_FAVORITE', false);
    }
    
    public function checkIfFavorited()
    {
        $favoriteService = app(FavoriteService::class);
        $this->isFavorited = $favoriteService->isInFavorites($this->book);
    }
    
    public function toggleFavorite()
    {
        if ($this->requiresLogin) {
            // Store the intended URL for redirection after login
            Session::put('url.intended', url()->current());
            $this->redirect(route('login'));
            return;
        }
        
        $this->loading = true;
        
        try {
            $favoriteService = app(FavoriteService::class);
            $wasAdded = $favoriteService->toggleFavorite($this->book);
            
            $this->isFavorited = !$this->isFavorited;
            $this->successMessage = $wasAdded ? 'Added to favorites!' : 'Removed from favorites!';
            $this->dispatch('favorites-updated');
            
            // Clear success message after 3 seconds
            $this->js('setTimeout(() => { $wire.successMessage = null; }, 3000)');
        } finally {
            $this->loading = false;
        }
    }
    
    public function viewFavorites()
    {
        $this->redirect(route('favorites.index'));
    }
}; ?>

<div>
    <button
        wire:click="toggleFavorite"
        wire:loading.attr="disabled"
        wire:loading.class="opacity-70 cursor-not-allowed"
        class="flex items-center justify-center rounded-full w-10 h-10 bg-white dark:bg-gray-700 shadow-md hover:shadow-lg transition-all {{ $isFavorited ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }}"
        aria-label="{{ $isFavorited ? 'Remove from favorites' : 'Add to favorites' }}"
    >
        <span wire:loading wire:target="toggleFavorite" class="inline-block animate-spin">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        </span>
        <span wire:loading.remove wire:target="toggleFavorite">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </span>
    </button>
    
    @if($successMessage)
        <div class="rounded-md bg-green-50 dark:bg-green-900/30 p-3 mt-2 text-green-700 dark:text-green-300 text-center text-sm animate-fade-in">
            {{ $successMessage }}
        </div>
    @endif
</div>