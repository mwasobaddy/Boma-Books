<?php

namespace App\Livewire\Favorites;

use App\Models\Book;
use App\Services\FavoriteService;
use Livewire\Component;

class FavoritesList extends Component
{
    public $favorites = [];
    public $emptyFavoritesMessage = 'Your favorites list is empty.';
    
    protected $favoriteService;
    
    public function boot(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }
    
    public function mount()
    {
        $this->loadFavorites();
    }
    
    public function loadFavorites()
    {
        $this->favorites = $this->favoriteService->getFavorites();
    }
    
    public function removeFromFavorites($bookId)
    {
        $book = Book::find($bookId);
        
        if ($book) {
            $this->favoriteService->removeFromFavorites($book);
            $this->loadFavorites();
            $this->dispatch('favorites-updated');
        }
    }
    
    public function render()
    {
        return view('livewire.favorites.favorites-list');
    }
}
