<?php

use App\Services\CartService;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    public $cartItems = [];
    public $subtotal = 0;
    public float $tax = 0;
    public float $total = 0;
    public bool $processing = false;
    
    public function mount()
    {
        $this->refreshCart();
    }
    
    public function refreshCart()
    {
        $cartService = app(CartService::class);
        $this->cartItems = $cartService->getCartItems();
        
        // Calculate totals
        $this->subtotal = 0;
        foreach ($this->cartItems as $item) {
            $this->subtotal += $item->book->price * $item->quantity;
        }
        
        // Apply a 10% tax
        $this->tax = $this->subtotal * 0.10;
        $this->total = $this->subtotal + $this->tax;
    }
    
    #[On('cart-updated')]
    public function handleCartUpdated()
    {
        $this->refreshCart();
    }
    
    public function updateQuantity($cartItemId, $change)
    {
        $this->processing = true;
        
        try {
            $cartService = app(CartService::class);
            
            foreach ($this->cartItems as $item) {
                if ($item->id === $cartItemId) {
                    $newQuantity = $item->quantity + $change;
                    
                    if ($newQuantity < 1) {
                        $this->removeItem($cartItemId);
                        return;
                    }
                    
                    $cartService->updateQuantity($cartItemId, $newQuantity);
                    break;
                }
            }
            
            $this->refreshCart();
            $this->dispatch('cart-updated');
            
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Error updating quantity: ' . $e->getMessage()
            ]);
        }
        
        $this->processing = false;
    }
    
    public function removeItem($cartItemId)
    {
        $this->processing = true;
        
        try {
            $cartService = app(CartService::class);
            $cartService->removeFromCart($cartItemId);
            
            $this->refreshCart();
            $this->dispatch('cart-updated');
            
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Item removed from cart'
            ]);
            
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Error removing item: ' . $e->getMessage()
            ]);
        }
        
        $this->processing = false;
    }
    
    public function checkout()
    {
        // This will be implemented in the future
        $this->dispatch('notify', [
            'type' => 'info',
            'message' => 'Checkout functionality will be implemented soon!'
        ]);
    }
}; ?>

<div>
    @if(count($cartItems) > 0)
        <div class="space-y-8">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($cartItems as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-20 w-14">
                                            @if($item->book->cover_image)
                                                <img class="h-20 w-14 object-cover shadow" src="{{ asset('storage/' . $item->book->cover_image) }}" alt="{{ $item->book->title }}">
                                            @else
                                                <div class="h-20 w-14 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400">
                                                    No Image
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $item->book->title }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $item->book->author }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">${{ number_format($item->book->price, 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <button 
                                            wire:click="updateQuantity({{ $item->id }}, -1)"
                                            wire:loading.attr="disabled"
                                            @if($processing) disabled @endif
                                            class="border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-l-md p-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 disabled:opacity-50"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <span class="border-y border-gray-300 dark:border-gray-600 dark:bg-gray-700 py-2 px-3 w-12 text-center">
                                            {{ $item->quantity }}
                                        </span>
                                        <button 
                                            wire:click="updateQuantity({{ $item->id }}, 1)"
                                            wire:loading.attr="disabled"
                                            @if($processing) disabled @endif
                                            class="border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-r-md p-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 disabled:opacity-50"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">${{ number_format($item->book->price * $item->quantity, 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button 
                                        wire:click="removeItem({{ $item->id }})"
                                        wire:loading.attr="disabled"
                                        @if($processing) disabled @endif
                                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 focus:outline-none disabled:opacity-50"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Order Summary</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-300">Subtotal</span>
                        <span class="text-gray-900 dark:text-gray-100">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-300">Tax (10%)</span>
                        <span class="text-gray-900 dark:text-gray-100">${{ number_format($tax, 2) }}</span>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-600 pt-2 mt-2">
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-900 dark:text-gray-100">Total</span>
                            <span class="font-bold text-gray-900 dark:text-gray-100">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Continue Shopping
                </a>

                <button 
                    wire:click="checkout"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    <div wire:loading wire:target="checkout" class="mr-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    Proceed to Checkout
                </button>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">Your cart is empty</h3>
            <p class="mt-2 text-gray-500 dark:text-gray-400">Looks like you haven't added any books to your cart yet.</p>
            <div class="mt-6">
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                    </svg>
                    Browse Books
                </a>
            </div>
        </div>
    @endif
</div>