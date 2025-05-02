<?php

namespace App\Services;

use App\Models\Book;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartService
{
    /**
     * Get a unique session ID for guest users.
     *
     * @return string
     */
    public function getSessionId(): string
    {
        $sessionId = Cookie::get('boma_cart_session');
        
        if (!$sessionId) {
            $sessionId = Str::uuid()->toString();
            Cookie::queue('boma_cart_session', $sessionId, 60 * 24 * 30); // 30 days cookie
        }
        
        return $sessionId;
    }
    
    /**
     * Get all cart items for the current user or session.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCartItems()
    {
        if (Auth::check()) {
            return CartItem::with('book')
                ->where('user_id', Auth::id())
                ->get();
        }
        
        $sessionId = $this->getSessionId();
        
        return CartItem::with('book')
            ->where('session_id', $sessionId)
            ->whereNull('user_id')
            ->get();
    }
    
    /**
     * Get the count of items in the cart.
     *
     * @return int
     */
    public function getCartCount(): int
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())->sum('quantity');
        }
        
        $sessionId = $this->getSessionId();
        
        return CartItem::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->sum('quantity');
    }
    
    /**
     * Add a book to the cart.
     *
     * @param Book $book
     * @param int $quantity
     * @return CartItem
     */
    public function addToCart(Book $book, int $quantity = 1): CartItem
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();
        
        // Find existing cart item
        $cartItem = CartItem::where('book_id', $book->id)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId)->whereNull('user_id');
            })
            ->first();
        
        if ($cartItem) {
            // Update quantity if item exists
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity,
            ]);
        } else {
            // Create new cart item
            $cartItem = CartItem::create([
                'user_id' => $userId,
                'book_id' => $book->id,
                'quantity' => $quantity,
                'session_id' => $userId ? null : $sessionId,
                'price' => $book->price,
            ]);
        }
        
        return $cartItem;
    }
    
    /**
     * Update a cart item's quantity.
     *
     * @param int $cartItemId
     * @param int $quantity
     * @return CartItem|null
     */
    public function updateCartItemQuantity(int $cartItemId, int $quantity): ?CartItem
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();
        
        $cartItem = CartItem::where('id', $cartItemId)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId)->whereNull('user_id');
            })
            ->first();
        
        if (!$cartItem) {
            return null;
        }
        
        if ($quantity <= 0) {
            $cartItem->delete();
            return null;
        }
        
        $cartItem->update(['quantity' => $quantity]);
        
        return $cartItem;
    }
    
    /**
     * Remove a book from the cart.
     *
     * @param int $cartItemId
     * @return bool
     */
    public function removeFromCart(int $cartItemId): bool
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();
        
        $deleted = CartItem::where('id', $cartItemId)
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
     * Clear the entire cart.
     *
     * @return bool
     */
    public function clearCart(): bool
    {
        $userId = Auth::id();
        $sessionId = $this->getSessionId();
        
        $deleted = CartItem::when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId)->whereNull('user_id');
            })
            ->delete();
        
        return $deleted > 0;
    }
    
    /**
     * Calculate the cart total.
     *
     * @return float
     */
    public function getCartTotal(): float
    {
        $cartItems = $this->getCartItems();
        
        return $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }
    
    /**
     * Merge guest cart items into user account after login
     *
     * @param string $sessionId
     * @param int $userId
     * @return int Number of items merged
     */
    public function mergeGuestCart(string $sessionId, int $userId): int
    {
        $guestCartItems = CartItem::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->with('book')
            ->get();
        
        $merged = 0;
        
        foreach ($guestCartItems as $guestItem) {
            // Check if user already has this book in their cart
            $existingItem = CartItem::where('user_id', $userId)
                ->where('book_id', $guestItem->book_id)
                ->first();
            
            if ($existingItem) {
                // Update existing cart item quantity
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $guestItem->quantity
                ]);
                
                // Remove guest item
                $guestItem->delete();
            } else {
                // Transfer guest item to user
                $guestItem->update([
                    'user_id' => $userId,
                    'session_id' => null
                ]);
            }
            
            $merged++;
        }
        
        return $merged;
    }
}