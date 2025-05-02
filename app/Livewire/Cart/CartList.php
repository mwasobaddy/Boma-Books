<?php

namespace App\Livewire\Cart;

use App\Services\CartService;
use Illuminate\Support\Collection;
use Livewire\Component;

class CartList extends Component
{
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

    #[\Livewire\Attributes\On('cart-updated')]
    public function handleCartUpdated()
    {
        $this->loadCart();
    }
    
    public function render()
    {
        return view('livewire.cart.cart-list');
    }
}
