<x-layouts.store>
    <div class="bg-gray-50 dark:bg-gray-900 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('shop.index') }}" class="ml-1 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 md:ml-2">Shop</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a 1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-gray-500 md:ml-2 line-clamp-1">{{ $book->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Book Detail Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <div class="md:flex">
                    <!-- Book Image -->
                    <div class="md:w-1/3 lg:w-1/4 relative bg-gray-100 dark:bg-gray-900">
                        <img class="w-full h-auto aspect-[2/3] object-contain" src="{{ $book->cover_image }}" alt="{{ $book->title }}">
                        @if($book->is_featured)
                            <span class="absolute top-4 right-4 bg-orange-500 text-white text-sm font-bold px-3 py-1 rounded">Featured</span>
                        @endif
                    </div>
                    
                    <!-- Book Details -->
                    <div class="md:w-2/3 lg:w-3/4 p-6 md:p-8">
                        <div class="mb-4">
                            <span class="inline-block bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-2">
                                {{ $book->category }}
                            </span>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">{{ $book->title }}</h1>
                            <p class="mt-1 text-lg text-gray-600 dark:text-gray-400">By {{ $book->author }}</p>
                        </div>
                        
                        <div class="my-4">
                            <div class="text-2xl font-bold text-orange-600 dark:text-orange-500">
                                {{ $book->formatted_price }}
                            </div>
                            <div class="mt-2">
                                @if($book->stock > 0)
                                    <span class="text-green-600 dark:text-green-500">In Stock ({{ $book->stock }} available)</span>
                                @else
                                    <span class="text-red-600 dark:text-red-500">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="prose dark:prose-dark max-w-none my-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Description</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $book->description }}</p>
                        </div>
                        
                        <div class="mt-6 space-y-3">
                            <div class="flex items-center text-sm">
                                <span class="text-gray-600 dark:text-gray-400 min-w-32">ISBN:</span>
                                <span class="text-gray-900 dark:text-white">{{ $book->isbn ?? 'Not available' }}</span>
                            </div>
                        </div>
                        
                        @if($book->stock > 0)
                            <div class="mt-8">
                                <form action="{{ route('cart.add', $book->id) }}" method="POST">
                                    @csrf
                                    <div class="flex items-center space-x-4">
                                        <div class="w-24">
                                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantity</label>
                                            <select name="quantity" id="quantity" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
                                                @for($i = 1; $i <= min(5, $book->stock); $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="py-3 px-6 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition duration-150 ease-in-out flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Add to Cart
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="mt-8">
                                <button disabled class="py-3 px-6 bg-gray-400 dark:bg-gray-700 text-white font-medium rounded-lg cursor-not-allowed">
                                    Out of Stock
                                </button>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">This item is currently out of stock. Please check back later.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Related Books -->
            @if($relatedBooks->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Related Books</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach($relatedBooks as $relatedBook)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                                <a href="{{ route('shop.show', $relatedBook->id) }}" class="block">
                                    <div class="relative pb-2/3">
                                        <img class="absolute h-full w-full object-cover" src="{{ $relatedBook->cover_image }}" alt="{{ $relatedBook->title }}">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $relatedBook->title }}</h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">By {{ $relatedBook->author }}</p>
                                        <p class="mt-2 text-orange-600 dark:text-orange-500 font-bold">{{ $relatedBook->formatted_price }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.store>