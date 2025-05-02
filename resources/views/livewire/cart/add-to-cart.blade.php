<?php

use App\Models\Book;
use App\Services\CartService;
use Livewire\Volt\Component;

new class extends Component {
    public Book $book;
    public int $quantity = 1;
    public string $buttonStyle = 'primary'; // primary or secondary
    public bool $showQuantity = true;
    public bool $processing = false;
    public ?string $message = null;
    
    public function mount(Book $book, string $buttonStyle = 'primary', bool $showQuantity = true)
    {
        $this->book = $book;
        $this->buttonStyle = $buttonStyle;
        $this->showQuantity = $showQuantity;
    }
    
    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }
    
    public function increaseQuantity()
    {
        $this->quantity++;
    }
    
    public function addToCart()
    {
        $this->processing = true;
        $this->message = null;
        
        try {
            $cartService = app(CartService::class);
            $cartService->addToCart($this->book, $this->quantity);
            
            $this->message = 'Added to cart successfully!';
            $this->dispatch('cart-updated');
            
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Book added to cart successfully!'
            ]);
            
        } catch (\Exception $e) {
            $this->message = 'Failed to add to cart.';
            
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to add book to cart. ' . $e->getMessage()
            ]);
        }
        
        $this->processing = false;
    }
}; ?>

<div class="flex flex-col gap-3">
    @if($showQuantity)
        <div class="flex items-center">
            <label for="quantity" class="mr-3 text-sm font-medium text-gray-700 dark:text-gray-300">Quantity:</label>
            <div class="flex items-center">
                <button 
                    type="button" 
                    wire:click="decreaseQuantity" 
                    class="border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-l-md p-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 disabled:opacity-50"
                    @if($quantity <= 1 || $processing) disabled @endif
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </button>
                <input 
                    type="number" 
                    id="quantity" 
                    wire:model="quantity" 
                    readonly
                    class="border-y border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white py-2 px-3 w-12 text-center focus:outline-none"
                >
                <button 
                    type="button" 
                    wire:click="increaseQuantity" 
                    class="border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-r-md p-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 disabled:opacity-50"
                    @if($processing) disabled @endif
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if($buttonStyle === 'primary')
        <button 
            wire:click="addToCart" 
            wire:loading.class="opacity-75" 
            wire:loading.attr="disabled" 
            @if($processing) disabled @endif
            class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors disabled:opacity-50"
        >
            <div wire:loading wire:target="addToCart" class="mr-2">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Add to Cart
        </button>
    @else
        <button 
            wire:click="addToCart" 
            wire:loading.class="opacity-75" 
            wire:loading.attr="disabled" 
            @if($processing) disabled @endif
            class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md shadow-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors disabled:opacity-50"
        >
            <div wire:loading wire:target="addToCart" class="mr-2">
                <svg class="animate-spin h-5 w-5 text-gray-700 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Add to Cart
        </button>
    @endif

    @if($message)
        <p class="mt-2 text-sm {{ str_contains($message, 'success') ? 'text-green-600' : 'text-red-600' }}">
            {{ $message }}
        </p>
    @endif
</div>