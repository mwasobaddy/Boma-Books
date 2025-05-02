<?php

use App\Services\CartService;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    public $cartCount = 0;
    
    public function mount()
    {
        $this->updateCartCount();
    }
    
    public function updateCartCount()
    {
        $cartService = app(CartService::class);
        $this->cartCount = $cartService->getCartCount();
    }
    
    #[On('cart-updated')]
    public function handleCartUpdated()
    {
        $this->updateCartCount();
    }
}; ?>

<a href="{{ route('cart.index') }}" class="relative p-2 mr-4 text-gray-600 hover:text-orange-600 dark:text-gray-400 dark:hover:text-orange-500 transition duration-150 ease-in-out group">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    @if($cartCount > 0)
        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-orange-600 rounded-full">{{ $cartCount }}</span>
    @endif
    <span class="hidden group-hover:block absolute top-10 right-0 bg-white dark:bg-gray-700 rounded-md shadow-lg text-sm py-1 px-2 whitespace-nowrap">
        Cart
    </span>
</a>