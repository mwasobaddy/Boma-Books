<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index(Request $request)
    {
        $query = Book::published();

        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Sort by different fields
        $sortField = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');
        
        $allowedSortFields = ['title', 'price', 'author', 'created_at'];
        
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortDirection === 'asc' ? 'asc' : 'desc');
        }

        $books = $query->paginate(12);
        
        // Get unique categories for the filter
        $categories = Book::published()->distinct()->pluck('category');

        return view('store.shop.index', compact('books', 'categories'));
    }

    /**
     * Display the specified book.
     */
    public function show($id)
    {
        $book = Book::published()->findOrFail($id);
        
        // Get related books in the same category
        $relatedBooks = Book::published()
            ->where('category', $book->category)
            ->where('id', '!=', $book->id)
            ->limit(4)
            ->get();
            
        return view('store.shop.show', compact('book', 'relatedBooks'));
    }
}
