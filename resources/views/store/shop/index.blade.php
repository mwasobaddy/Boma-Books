<x-layouts.store>
    <div class="bg-gray-50 dark:bg-gray-900 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Book Shop</h1>
                    <p class="mt-1 text-gray-600 dark:text-gray-400">Browse our collection of books</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="flex items-center space-x-4">
                        <!-- Sort dropdown -->
                        <div class="relative">
                            <select id="sort-select" onchange="updateSort(this.value)" class="appearance-none bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <option value="created_at-desc" {{ request('sort') == 'created_at' && request('direction') == 'desc' ? 'selected' : '' }}>Newest</option>
                                <option value="created_at-asc" {{ request('sort') == 'created_at' && request('direction') == 'asc' ? 'selected' : '' }}>Oldest</option>
                                <option value="title-asc" {{ request('sort') == 'title' && request('direction') == 'asc' ? 'selected' : '' }}>Title (A-Z)</option>
                                <option value="title-desc" {{ request('sort') == 'title' && request('direction') == 'desc' ? 'selected' : '' }}>Title (Z-A)</option>
                                <option value="price-asc" {{ request('sort') == 'price' && request('direction') == 'asc' ? 'selected' : '' }}>Price (Low-High)</option>
                                <option value="price-desc" {{ request('sort') == 'price' && request('direction') == 'desc' ? 'selected' : '' }}>Price (High-Low)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row">
                <!-- Sidebar for filters -->
                <div class="w-full lg:w-1/4 mb-6 lg:mb-0 lg:pr-6">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <h2 class="font-semibold text-lg text-gray-900 dark:text-white mb-4">Filters</h2>
                        
                        <!-- Category filter -->
                        <div class="mb-4">
                            <h3 class="font-medium text-gray-800 dark:text-gray-200 mb-2">Categories</h3>
                            <div class="space-y-2">
                                <div>
                                    <a href="{{ route('shop.index') }}" class="block text-sm {{ !request('category') ? 'text-orange-600 dark:text-orange-500 font-medium' : 'text-gray-700 dark:text-gray-300' }}">
                                        All Categories
                                    </a>
                                </div>
                                @foreach($categories as $category)
                                    <div>
                                        <a href="{{ route('shop.index', ['category' => $category]) }}" class="block text-sm {{ request('category') == $category ? 'text-orange-600 dark:text-orange-500 font-medium' : 'text-gray-700 dark:text-gray-300' }}">
                                            {{ $category }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content / book grid -->
                <div class="w-full lg:w-3/4">
                    @if($books->isEmpty())
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-8 text-center">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">No books found</h3>
                            <p class="text-gray-600 dark:text-gray-400">Try adjusting your filters or check back later for new releases.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($books as $book)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden flex flex-col">
                                    <a href="{{ route('shop.show', $book->id) }}" class="block">
                                        <div class="relative pb-2/3">
                                            <img class="absolute h-full w-full object-cover" src="{{ $book->cover_image }}" alt="{{ $book->title }}">
                                            @if($book->is_featured)
                                                <span class="absolute top-2 right-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</span>
                                            @endif
                                            @if($book->stock <= 0)
                                                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">Out of Stock</span>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="p-4 flex-1 flex flex-col">
                                        <div class="flex justify-between items-start">
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                {{ $book->category }}
                                            </span>
                                            <span class="text-orange-600 dark:text-orange-500 font-bold">{{ $book->formatted_price }}</span>
                                        </div>
                                        <a href="{{ route('shop.show', $book->id) }}" class="block mt-2">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white line-clamp-2">{{ $book->title }}</h3>
                                        </a>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">By {{ $book->author }}</p>
                                        <p class="mt-2 text-gray-700 dark:text-gray-300 text-sm line-clamp-3 flex-grow">
                                            {{ \Illuminate\Support\Str::limit($book->description, 100) }}
                                        </p>
                                        
                                        @if($book->stock > 0)
                                            <form action="{{ route('cart.add', $book->id) }}" method="POST" class="mt-4">
                                                @csrf
                                                @auth
                                                    <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                        Add to Cart
                                                    </button>
                                                @else
                                                    <a href="{{ route('login') }}" class="block text-center w-full border border-orange-600 text-orange-600 dark:border-orange-500 dark:text-orange-500 hover:bg-orange-50 dark:hover:bg-gray-800 font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                                        Login to Purchase
                                                    </a>
                                                @endauth
                                            </form>
                                        @else
                                            <button disabled class="mt-4 w-full bg-gray-400 dark:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg cursor-not-allowed">
                                                Out of Stock
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $books->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateSort(value) {
            const [sort, direction] = value.split('-');
            
            // Get current URL and query parameters
            const url = new URL(window.location);
            
            // Update or add the sort and direction parameters
            url.searchParams.set('sort', sort);
            url.searchParams.set('direction', direction);
            
            // Redirect to new URL with updated parameters
            window.location = url.toString();
        }
    </script>
</x-layouts.store>