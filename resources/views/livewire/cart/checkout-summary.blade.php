<?php

use App\Services\CartService;
use Livewire\Volt\Component;

new class extends Component {
    public $cartItems = [];
    public $subtotal = 0;
    public $shipping = 0;
    public $tax = 0;
    public $total = 0;
    
    public function mount()
    {
        $this->loadCartSummary();
    }
    
    public function loadCartSummary()
    {
        $cartService = app(CartService::class);
        $this->cartItems = $cartService->getCartItems();
        $this->subtotal = $cartService->getCartTotal();
        // In a real application, you would calculate tax and shipping based on locale, weight, etc.
        $this->tax = $this->subtotal * 0.0825; // Example: 8.25% tax
        $this->shipping = 0; // Free shipping
        $this->total = $this->subtotal + $this->tax + $this->shipping;
    }
    
    #[On('cart-updated')]
    public function handleCartUpdated()
    {
        $this->loadCartSummary();
    }
}; ?>

<div>
    @if(count($cartItems) > 0)
        <div class="space-y-4">
            @foreach($cartItems as $item)
                <div class="flex justify-between text-sm">
                    <div>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $item->book->title }}</span>
                        <span class="text-gray-600 dark:text-gray-400 ml-2">× {{ $item->quantity }}</span>
                    </div>
                    <span class="text-gray-900 dark:text-white">${{ number_format($item->price * $item->quantity, 2) }}</span>
                </div>
            @endforeach
            
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4 space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                    <span class="text-gray-900 dark:text-white">${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600 dark:text-gray-400">Tax</span>
                    <span class="text-gray-900 dark:text-white">${{ number_format($tax, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                    <span class="text-gray-900 dark:text-white">{{ $shipping > 0 ? '$'.number_format($shipping, 2) : 'Free' }}</span>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-3 flex justify-between">
                    <span class="font-semibold text-gray-900 dark:text-white">Total</span>
                    <span class="font-bold text-lg text-gray-900 dark:text-white">${{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-4">
            <p class="text-gray-600 dark:text-gray-400">Your cart is empty.</p>
        </div>
    @endif
</div>