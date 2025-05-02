<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class FavoriteService
{
    /**
     * Get a unique session ID for guest users.
     *
     * @return string
     */
    public function getSessionId(): string
    {
        $sessionId = Cookie::get('boma_favorite_session');
        
        if (!$sessionId) {
            $sessionId = Str::uuid()->toString();
            Cookie::queue('boma_favorite_session', $sessionId, 60 * 24 * 30); // 30 days cookie
        }
        
        return $sessionId;
    }
    
    /**
     * Get all favorites for the current user or session.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFavorites()
    {
        if (Auth::check()) {
            return Favorite::with('book')
                ->where('user_id', Auth::id())
                ->get();
        }
        
        $sessionId = $this->getSessionId();
        
        return Favorite::with('book')
            ->where('session_id', $sessionId)
            ->whereNull('user_id')
            ->get();
    }
    
    /**
     * Get the count of favorites.
     *
     * @return int
     */
    public function getFavoritesCount(): int
    {
        if (Auth::check()) {
            return Favorite::where('user_id', Auth::id())->count();
        }
        
        $sessionId = $this->getSessionId();
        
        return Favorite::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->count();
    }
    
    /**
     * Add a book to favorites.
     *
     * @param Book $book
     * @return Favorite|null
     */
    public function addToFavorites(Book $book): ?Favorite
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();
        
        // Check if already in favorites
        $favorite = Favorite::where('book_id', $book->id)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId)->whereNull('user_id');
            })
            ->first();
        
        if ($favorite) {
            // Already in favorites
            return null;
        }
        
        // Create new favorite
        $favorite = Favorite::create([
            'user_id' => $userId,
            'book_id' => $book->id,
            'session_id' => $userId ? null : $sessionId,
        ]);
        
        return $favorite;
    }
    
    /**
     * Check if a book is in favorites.
     *
     * @param Book $book
     * @return bool
     */
    public function isInFavorites(Book $book): bool
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();
        
        return Favorite::where('book_id', $book->id)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId)->whereNull('user_id');
            })
            ->exists();
    }
    
    /**
     * Toggle favorite status for a book.
     *
     * @param Book $book
     * @return bool True if added to favorites, false if removed
     */
    public function toggleFavorite(Book $book): bool
    {
        if ($this->isInFavorites($book)) {
            $this->removeFromFavorites($book);
            return false;
        } else {
            $this->addToFavorites($book);
            return true;
        }
    }
    
    /**
     * Remove a book from favorites.
     *
     * @param Book $book
     * @return bool
     */
    public function removeFromFavorites(Book $book): bool
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();
        
        $deleted = Favorite::where('book_id', $book->id)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId)->whereNull('user_id');
            })
            ->delete();
        
        return $deleted > 0;
    }
    
    /**
     * Clear all favorites.
     *
     * @return bool
     */
    public function clearFavorites(): bool
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();
        
        $deleted = Favorite::when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId)->whereNull('user_id');
            })
            ->delete();
        
        return $deleted > 0;
    }
    
    /**
     * Merge guest favorites into user account after login
     *
     * @param string $sessionId
     * @param int $userId
     * @return int Number of favorites merged
     */
    public function mergeGuestFavorites(string $sessionId, int $userId): int
    {
        $guestFavorites = Favorite::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->with('book')
            ->get();
        
        $merged = 0;
        
        foreach ($guestFavorites as $guestFavorite) {
            // Check if user already has this book in their favorites
            $existingFavorite = Favorite::where('user_id', $userId)
                ->where('book_id', $guestFavorite->book_id)
                ->first();
            
            if ($existingFavorite) {
                // Already in favorites, remove guest entry
                $guestFavorite->delete();
            } else {
                // Transfer guest favorite to user
                $guestFavorite->update([
                    'user_id' => $userId,
                    'session_id' => null
                ]);
            }
            
            $merged++;
        }
        
        return $merged;
    }
}