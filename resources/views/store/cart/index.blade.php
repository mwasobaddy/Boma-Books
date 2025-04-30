<x-layouts.store>
    <div class="bg-gray-50 dark:bg-gray-900 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-8">Your Shopping Cart</h1>

            @if(session('success'))
                <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="p-4 mb-6 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                    {{ session('warning') }}
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if(count($books) > 0)
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
                                        @foreach($books as $book)
                                            <tr class="border-b dark:border-gray-700">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <img class="w-16 h-24 object-cover mr-4" src="{{ $book->cover_image }}" alt="{{ $book->title }}">
                                                        <div>
                                                            <h3 class="font-medium text-gray-900 dark:text-white">{{ $book->title }}</h3>
                                                            <p class="text-gray-600 dark:text-gray-400">{{ $book->author }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-gray-900 dark:text-white">
                                                    {{ $book->formatted_price }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <form action="{{ route('cart.update', $book->id) }}" method="POST" class="flex items-center">
                                                        @csrf
                                                        @method('PATCH')
                                                        <select name="quantity" id="quantity-{{ $book->id }}" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-16 p-2.5" onchange="this.form.submit()">
                                                            @for($i = 1; $i <= min(10, $book->stock); $i++)
                                                                <option value="{{ $i }}" {{ $book->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </form>
                                                </td>
                                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                    ${{ number_format($book->price * $book->quantity, 2) }}
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <form action="{{ route('cart.remove', $book->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex justify-between items-center">
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-500">
                                            Clear Cart
                                        </button>
                                    </form>
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
                                <a href="{{ route('checkout') }}" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-3 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
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
    </div>
</x-layouts.store>