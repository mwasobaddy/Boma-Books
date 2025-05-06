<x-layouts.store>
    <div class="bg-gray-50 dark:bg-gray-900 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-8">Checkout</h1>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Checkout Form -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Shipping Information</h2>
                            
                            <form>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="first-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">First name</label>
                                        <input type="text" name="first-name" id="first-name" value="{{ auth()->user()->name }}" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
                                    </div>
                                    
                                    <div>
                                        <label for="last-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last name</label>
                                        <input type="text" name="last-name" id="last-name" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
                                    </div>
                                    
                                    <div class="md:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email address</label>
                                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
                                    </div>
                                    
                                    <div class="md:col-span-2">
                                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Street address</label>
                                        <input type="text" name="address" id="address" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
                                    </div>
                                    
                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                                        <input type="text" name="city" id="city" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
                                    </div>
                                    
                                    <div>
                                        <label for="postal-code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ZIP / Postal code</label>
                                        <input type="text" name="postal-code" id="postal-code" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
                                    </div>
                                </div>
                                
                                <div class="mt-8">
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Payment Information</h2>
                                    
                                    <div class="grid grid-cols-1 gap-6">
                                        <div>
                                            <label for="card-number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Card number</label>
                                            <input type="text" name="card-number" id="card-number" placeholder="•••• •••• •••• ••••" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
                                        </div>
                                        
                                        <div class="grid grid-cols-2 gap-6">
                                            <div>
                                                <label for="expiration-date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Expiration date (MM/YY)</label>
                                                <input type="text" name="expiration-date" id="expiration-date" placeholder="MM/YY" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
                                            </div>
                                            
                                            <div>
                                                <label for="cvc" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CVC</label>
                                                <input type="text" name="cvc" id="cvc" placeholder="•••" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-8">
                                    <button type="button" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-3 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                                        Complete Purchase
                                    </button>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 text-center mt-4">
                                        <span class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            Secure payment processing. Your information is protected.
                                        </span>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Summary</h2>
                        
                        <div class="space-y-4">
                            @foreach($cartItems as $cartItem)
                                <div class="flex items-start">
                                    <img class="w-12 h-16 object-cover mr-4" src="{{ $cartItem->book->cover_image }}" alt="{{ $cartItem->book->title }}">
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $cartItem->book->title }}</h4>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Qty: {{ $cartItem->quantity }}</p>
                                    </div>
                                    <span class="text-sm text-gray-900 dark:text-white">${{ number_format($cartItem->book->price * $cartItem->quantity, 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 mt-6 pt-6 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                                <span class="text-gray-900 dark:text-white">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                                <span class="text-gray-900 dark:text-white">Free</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Tax</span>
                                <span class="text-gray-900 dark:text-white">${{ number_format($total * 0.07, 2) }}</span>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-3">
                                <div class="flex justify-between">
                                    <span class="font-semibold text-gray-900 dark:text-white">Total</span>
                                    <span class="font-bold text-lg text-gray-900 dark:text-white">${{ number_format($total * 1.07, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('cart.index') }}" class="text-sm text-orange-600 dark:text-orange-500 hover:underline flex items-center" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Return to cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.store>