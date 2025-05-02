<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'description',
        'price',
        'cover_image',
        'category_id',
        'category', // Legacy field, keeping for now
        'stock',
        'is_featured',
        'is_published',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    /**
     * Get the category that owns the book.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the cart items for this book.
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get the favorites for this book.
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Check if the book is in the cart for the given session or user
     */
    public function isInCart($sessionId = null, $userId = null): bool
    {
        $query = $this->cartItems();
        
        if ($userId) {
            return $query->where('user_id', $userId)->exists();
        }
        
        if ($sessionId) {
            return $query->where('session_id', $sessionId)->exists();
        }
        
        return false;
    }

    /**
     * Check if the book is favorited for the given session or user
     */
    public function isFavorited($sessionId = null, $userId = null): bool
    {
        $query = $this->favorites();
        
        if ($userId) {
            return $query->where('user_id', $userId)->exists();
        }
        
        if ($sessionId) {
            return $query->where('session_id', $sessionId)->exists();
        }
        
        return false;
    }

    /**
     * Get the formatted price with currency symbol.
     *
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    /**
     * Scope a query to only include published books.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include featured books.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
