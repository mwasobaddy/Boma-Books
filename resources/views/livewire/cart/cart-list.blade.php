<?php

use App\Services\CartService;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;

new class extends Component {
    public $cartItems;
    public $total = 0;
    
    public function mount()
    {
        $this->cartItems = new Collection();
        $this->loadCart();
    }
    
    public function loadCart()
    {
        $cartService = app(CartService::class);
        $this->cartItems = $cartService->getCartItems();
        $this->total = $cartService->getCartTotal();
    }
    
    public function updateQuantity($itemId, $quantity)
    {
        $cartService = app(CartService::class);
        $cartService->updateCartItemQuantity($itemId, $quantity);
        $this->loadCart();
        $this->dispatch('cart-updated');
    }
    
    public function removeItem($itemId)
    {
        $cartService = app(CartService::class);
        $cartService->removeFromCart($itemId);
        $this->loadCart();
        $this->dispatch('cart-updated');
    }
    
    public function clearCart()
    {
        $cartService = app(CartService::class);
        $cartService->clearCart();
        $this->loadCart();
        $this->dispatch('cart-updated');
    }
    
    #[On('cart-updated')]
    public function handleCartUpdated()
    {
        $this->loadCart();
    }
}; ?>

<div>
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-8">Your Shopping Cart</h1>

    @if(count($cartItems) > 0)
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Book</th>
                                    <th scope="col" class="px-6 py-3">Price</th>
                                    <th scope="col" class="px-6 py-3">Quantity</th>
                                    <th scope="col" class="px-6 py-3">Total</th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($item->book->cover_image)
                                                    <img class="w-16 h-24 object-cover mr-4" src="{{ asset('storage/' . $item->book->cover_image) }}" alt="{{ $item->book->title }}">
                                                @else
                                                    <div class="w-16 h-24 bg-gray-200 dark:bg-gray-700 mr-4 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h3 class="font-medium text-gray-900 dark:text-white">{{ $item->book->title }}</h3>
                                                    <p class="text-gray-600 dark:text-gray-400">{{ $item->book->author }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-white">
                                            ${{ number_format($item->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <select 
                                                wire:change="updateQuantity('{{ $item->id }}', $event.target.value)"
                                                class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-16 p-2.5"
                                            >
                                                @for($i = 1; $i <= min(10, $item->book->stock ?? 10); $i++)
                                                    <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            ${{ number_format($item->price * $item->quantity, 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button 
                                                wire:click="removeItem('{{ $item->id }}')"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                            >
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <button 
                                wire:click="clearCart"
                                class="text-sm text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 transition-colors"
                            >
                                Clear Cart
                            </button>
                            <a href="{{ route('shop.index') }}" class="flex items-center text-orange-600 dark:text-orange-500 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Summary</h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                            <span class="text-gray-900 dark:text-white">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                            <span class="text-gray-900 dark:text-white">Free</span>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-3">
                            <div class="flex justify-between">
                                <span class="font-semibold text-gray-900 dark:text-white">Total</span>
                                <span class="font-bold text-lg text-gray-900 dark:text-white">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('cart.checkout') }}" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-3 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            Proceed to Checkout
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <p class="text-xs text-gray-600 dark:text-gray-400 text-center mt-4">Secure payment processing. 100% Satisfaction Guaranteed.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h2 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">Your cart is empty</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Looks like you haven't added any books to your cart yet.</p>
            <a href="{{ route('shop.index') }}" class="mt-6 inline-block bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-6 rounded-lg transition duration-150 ease-in-out">
                Browse Books
            </a>
        </div>
    @endif
</div>