<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\FavoriteService;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    protected $favoriteService;
    
    /**
     * Create a new controller instance.
     */
    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    /**
     * Display the favorites list.
     */
    public function index()
    {
        $favorites = $this->favoriteService->getFavorites();
        
        return view('store.favorites.index', compact('favorites'));
    }

    /**
     * Add a book to favorites.
     */
    public function add(Book $book)
    {
        $this->favoriteService->addToFavorites($book);
        return redirect()->back()->with('success', 'Book has been added to your favorites!');
    }

    /**
     * Remove a book from favorites.
     */
    public function remove(Book $book)
    {
        $this->favoriteService->removeFromFavorites($book);
        return redirect()->back()->with('success', 'Book removed from favorites!');
    }

    /**
     * Toggle favorite status of a book.
     */
    public function toggle(Book $book)
    {
        $added = $this->favoriteService->toggleFavorite($book);
        $message = $added ? 'Book has been added to your favorites!' : 'Book has been removed from your favorites!';
        
        return redirect()->back()->with('success', $message);
    }

    /**
     * Clear all favorites.
     */
    public function clear()
    {
        $this->favoriteService->clearFavorites();
        return redirect()->back()->with('success', 'Favorites have been cleared!');
    }
}
