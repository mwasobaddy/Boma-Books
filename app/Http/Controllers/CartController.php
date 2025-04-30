<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $books = [];
        $total = 0;

        if (count($cart) > 0) {
            $bookIds = array_keys($cart);
            $books = Book::whereIn('id', $bookIds)->get();
            
            foreach ($books as $book) {
                $book->quantity = $cart[$book->id];
                $total += $book->price * $cart[$book->id];
            }
        }

        return view('store.cart.index', compact('books', 'total'));
    }

    /**
     * Add a book to the cart.
     */
    public function add(Request $request, $id)
    {
        // Verify the book exists and is available
        $book = Book::published()->findOrFail($id);
        
        // Check if we're authenticated - if not, redirect to login
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please login to add items to your cart.');
        }
        
        // Check if the book is in stock
        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Sorry, this book is out of stock.');
        }

        // Add to cart
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id] += $request->input('quantity', 1);
        } else {
            $cart[$id] = $request->input('quantity', 1);
        }
        
        // Make sure the quantity doesn't exceed what's in stock
        if ($cart[$id] > $book->stock) {
            $cart[$id] = $book->stock;
            Session::put('cart', $cart);
            return redirect()->back()->with('warning', "We've added the maximum available quantity to your cart.");
        }
        
        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', 'Book has been added to your cart!');
    }

    /**
     * Update the quantity of a book in the cart.
     */
    public function update(Request $request, $id)
    {
        // Check if we're authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $book = Book::findOrFail($id);
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            $quantity = max(1, min($request->quantity, $book->stock));
            $cart[$id] = $quantity;
            Session::put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Cart updated!');
    }

    /**
     * Remove a book from the cart.
     */
    public function remove($id)
    {
        // Check if we're authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Book removed from cart!');
    }

    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Cart has been cleared!');
    }

    /**
     * Show the checkout page.
     */
    public function checkout()
    {
        // This is a placeholder - the actual implementation would involve
        // payment gateway integration, shipping options, etc.
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please login to checkout.');
        }

        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $bookIds = array_keys($cart);
        $books = Book::whereIn('id', $bookIds)->get();
        $total = 0;
        
        foreach ($books as $book) {
            $book->quantity = $cart[$book->id];
            $total += $book->price * $cart[$book->id];
        }

        return view('store.cart.checkout', compact('books', 'total'));
    }
}
