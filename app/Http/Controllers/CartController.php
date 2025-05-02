<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;
    
    /**
     * Create a new controller instance.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the cart contents.
     */
    public function index()
    {
        $cartItems = $this->cartService->getCartItems();
        $total = $this->cartService->getCartTotal();
        
        return view('store.cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add a book to the cart.
     */
    public function add(Request $request, Book $book)
    {
        // Check if the book is in stock
        if ($book->stock <= 0) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Sorry, this book is out of stock.']);
            }
            return redirect()->back()->with('error', 'Sorry, this book is out of stock.');
        }

        $quantity = max(1, $request->input('quantity', 1));
        
        // Make sure the quantity doesn't exceed what's in stock
        if ($quantity > $book->stock) {
            $quantity = $book->stock;
            $this->cartService->addToCart($book, $quantity);
            
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => "We've added the maximum available quantity to your cart."]);
            }
            return redirect()->back()->with('warning', "We've added the maximum available quantity to your cart.");
        }
        
        $this->cartService->addToCart($book, $quantity);
        
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Book has been added to your cart!']);
        }
        return redirect()->back()->with('success', 'Book has been added to your cart!');
    }

    /**
     * Update the quantity of a book in the cart.
     */
    public function update(Request $request, $cartItemId)
    {
        $quantity = max(1, $request->input('quantity', 1));
        $this->cartService->updateCartItemQuantity($cartItemId, $quantity);
        
        return redirect()->back()->with('success', 'Cart updated!');
    }

    /**
     * Remove a book from the cart.
     */
    public function remove($cartItemId)
    {
        $this->cartService->removeFromCart($cartItemId);
        return redirect()->back()->with('success', 'Book removed from cart!');
    }

    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        $this->cartService->clearCart();
        return redirect()->back()->with('success', 'Cart has been cleared!');
    }

    /**
     * Show the checkout page.
     */
    public function checkout()
    {
        $cartItems = $this->cartService->getCartItems();
        $total = $this->cartService->getCartTotal();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        if (!auth()->check()) {
            // Save the checkout URL for redirection after login
            session()->put('url.intended', route('cart.checkout'));
            return redirect()->route('login')->with('message', 'Please login to checkout.');
        }

        return view('store.cart.checkout', compact('cartItems', 'total'));
    }
}
