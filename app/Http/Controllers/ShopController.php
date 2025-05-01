<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the books, optionally filtered by category.
     */
    public function index(Request $request, Category $category = null)
    {
        // Load all active categories for sidebar/filter
        $categories = Category::active()->withCount('books')->get();

        // Determine if filtering by category (by slug)
        $categorySlug = $request->route('category');
        $selectedCategory = null;
        $query = Book::published();
        if ($categorySlug) {
            $selectedCategory = Category::where('slug', $categorySlug)->firstOrFail();
            $query->where('category_id', $selectedCategory->id);
        }

        // Sorting
        $sortField = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');
        $allowedSortFields = ['title', 'price', 'author', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }
        $query->orderBy($sortField, $sortDirection);

        $books = $query->paginate(12);

        return view('store.shop.index', [
            'books' => $books,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    /**
     * Display the specified book.
     */
    public function show($id)
    {
        $book = Book::published()->findOrFail($id);
        $relatedBooks = Book::published()
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->limit(4)
            ->get();
        return view('store.shop.show', compact('book', 'relatedBooks'));
    }
}
