<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     */
    public function index()
    {
        $categories = Category::withCount('books')->get();
        
        return view('store.categories.index', compact('categories'));
    }

    /**
     * Display the specified category with its books.
     */
    public function show(Request $request, Category $category)
    {
        // Get all categories with book counts for the sidebar
        $categories = Category::withCount('books')->get();
        
        // Get sorting parameters
        $sort = $request->query('sort', 'created_at');
        $direction = $request->query('direction', 'desc');
        
        // Validate sort column to prevent SQL injection
        $allowedSorts = ['title', 'author', 'price', 'created_at'];
        $sort = in_array($sort, $allowedSorts) ? $sort : 'created_at';
        
        // Validate direction
        $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'desc';
        
        // Get books in this category with pagination
        $books = $category->books()
            ->orderBy($sort, $direction)
            ->paginate(12);
        
        return view('store.categories.show', compact('category', 'categories', 'books'));
    }
    
    /**
     * API endpoint to get categories for navbar
     */
    public function apiIndex()
    {
        $categories = Category::withCount('books')
            ->orderBy('name')
            ->get(['id', 'name', 'slug']);
            
        return response()->json($categories);
    }
}
