<x-layouts.store>
    <div class="bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 min-h-screen py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb - Modernized with subtle separators -->
            <nav class="flex mb-6 text-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="flex text-gray-500 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            @if(isset($selectedCategory))
                                <a href="{{ route('shop.index') }}" class="ml-1 text-gray-500 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200 md:ml-2" wire:navigate>Shop</a>
                            @else
                                <span class="ml-1 text-gray-700 dark:text-gray-300 md:ml-2 font-medium">Shop</span>
                            @endif
                        </div>
                    </li>
                    @if(isset($selectedCategory))
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-700 dark:text-gray-300 md:ml-2 font-medium">{{ $selectedCategory->name }}</span>
                            </div>
                        </li>
                    @endif
                </ol>
            </nav>

            <!-- Page Header - Enhanced with subtle background and improved layout -->
            <div class="relative mb-12 rounded-2xl overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 p-6 md:p-8 shadow-sm">
                <div class="absolute top-0 right-0 w-32 h-32 md:w-64 md:h-64 rounded-full bg-orange-100 dark:bg-orange-900/20 -mr-12 -mt-12 opacity-40"></div>
                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white tracking-tight">
                            @if(isset($selectedCategory))
                                {{ $selectedCategory->name }}
                            @else
                                Discover Books
                            @endif
                        </h1>
                        <p class="mt-2 text-gray-600 dark:text-gray-300 max-w-xl">
                            @if(isset($selectedCategory) && $selectedCategory->description)
                                {{ $selectedCategory->description }}
                            @else
                                Explore our curated collection of books that inspire, entertain, and transform.
                            @endif
                        </p>
                        <div class="inline-flex items-center mt-3 px-3 py-1 bg-gray-100/80 dark:bg-gray-700/50 backdrop-blur-sm rounded-full text-sm text-gray-700 dark:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                            </svg>
                            {{ $books->total() }} {{ Str::plural('book', $books->total()) }} found
                        </div>
                    </div>
                    
                    <div class="flex-shrink-0">
                        <!-- Sort dropdown - Enhanced styling -->
                        <div class="relative">
                            <label for="sort-select" class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5 ml-1">Sort By</label>
                            <div class="relative">
                                <select id="sort-select" onchange="updateSort(this.value)" 
                                    class="appearance-none bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg pl-4 pr-10 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-shadow duration-200 min-w-[180px] shadow-sm hover:shadow-md">
                                    <option value="created_at-desc" {{ request('sort') == 'created_at' && request('direction') == 'desc' ? 'selected' : '' }}>Newest</option>
                                    <option value="created_at-asc" {{ request('sort') == 'created_at' && request('direction') == 'asc' ? 'selected' : '' }}>Oldest</option>
                                    <option value="title-asc" {{ request('sort') == 'title' && request('direction') == 'asc' ? 'selected' : '' }}>Title (A-Z)</option>
                                    <option value="title-desc" {{ request('sort') == 'title' && request('direction') == 'desc' ? 'selected' : '' }}>Title (Z-A)</option>
                                    <option value="price-asc" {{ request('sort') == 'price' && request('direction') == 'asc' ? 'selected' : '' }}>Price (Low-High)</option>
                                    <option value="price-desc" {{ request('sort') == 'price' && request('direction') == 'desc' ? 'selected' : '' }}>Price (High-Low)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 dark:text-gray-400">
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar for filters - Enhanced with better visual hierarchy -->
                <div class="w-full lg:w-1/4 flex-shrink-0">
                    <div class="sticky top-6">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                            <div class="p-5 border-b border-gray-100 dark:border-gray-700">
                                <h2 class="font-semibold text-lg text-gray-900 dark:text-white flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                                    </svg>
                                    Categories
                                </h2>
                            </div>
                            <div class="p-1">
                                <ul>
                                    <li>
                                        <a href="{{ route('shop.index') }}" 
                                           class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors duration-150 {{ !isset($selectedCategory) 
                                            ? 'bg-orange-50 text-orange-600 dark:bg-gray-700 dark:text-orange-400 font-medium' 
                                            : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                                            wire:navigate>
                                            <span class="flex-1">All Categories</span>
                                            <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $books->total() }}</span>
                                        </a>
                                    </li>
                                    @foreach($categories as $cat)
                                        <li>
                                            <a href="{{ route('categories.show', $cat->slug) }}" 
                                               class="flex items-center justify-between px-4 py-3 text-sm rounded-lg transition-colors duration-150 {{ isset($selectedCategory) && $selectedCategory->id === $cat->id 
                                                ? 'bg-orange-50 text-orange-600 dark:bg-gray-700 dark:text-orange-400 font-medium' 
                                                : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                                                wire:navigate>
                                                <span>{{ $cat->name }}</span>
                                                <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $cat->books_count }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content / book grid - Enhanced with improved cards and layout -->
                <div class="w-full lg:w-3/4">
                    @if($books->isEmpty())
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-12 text-center border border-gray-100 dark:border-gray-700">
                            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">No books found</h3>
                            <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto">Try adjusting your filters or check back later for new releases.</p>
                            <a href="{{ route('shop.index') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to all books
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach($books as $book)
                                <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col transition-all duration-300 transform hover:-translate-y-1">
                                    <a href="{{ route('shop.show', $book->id) }}" class="block relative overflow-hidden" wire:navigate>
                                        <div class="relative pb-[140%]"> <!-- 7:10 aspect ratio for books -->
                                            <img class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" 
                                                 src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-book-cover.png') }}" 
                                                 alt="{{ $book->title }}">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                            @if($book->is_featured)
                                                <div class="absolute top-3 right-3">
                                                    <span class="inline-flex items-center bg-orange-500 bg-opacity-95 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1.5 rounded-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        Featured
                                                    </span>
                                                </div>
                                            @endif
                                            @if($book->stock <= 0)
                                                <div class="absolute top-3 left-3">
                                                    <span class="inline-flex items-center bg-red-500 bg-opacity-95 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1.5 rounded-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                        </svg>
                                                        Out of Stock
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="p-5 flex-1 flex flex-col">
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="bg-blue-50 text-blue-700 dark:bg-blue-900 dark:text-blue-300 text-xs font-medium px-2.5 py-1 rounded-md">
                                                {{ $book->category->name ?? 'Uncategorized' }}
                                            </span>
                                            <span class="text-orange-600 dark:text-orange-400 font-bold">${{ number_format($book->price, 2) }}</span>
                                        </div>
                                        <a href="{{ route('shop.show', $book->id) }}" class="block" wire:navigate>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white line-clamp-2 mb-1 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200">{{ $book->title }}</h3>
                                        </a>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">By {{ $book->author }}</p>
                                        <p class="text-gray-700 dark:text-gray-300 text-sm line-clamp-3 flex-grow mb-4">
                                            {{ \Illuminate\Support\Str::limit($book->description, 120) }}
                                        </p>
                                        @if($book->stock > 0)
                                            <livewire:cart.add-to-cart
                                                :key="'add-to-cart-shop-'.$book->id"
                                                :book="$book"
                                                buttonStyle="secondary"
                                                showQuantity="true"
                                            />
                                        @else
                                            <button disabled class="w-full bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 font-medium py-2.5 px-4 rounded-lg cursor-not-allowed transition-colors duration-200">
                                                <span class="flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Out of Stock
                                                </span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination - Enhanced with better styling -->
                        <div class="mt-12">
                            {{ $books->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick view modal placeholder - Modern enhancement -->
    <div id="quick-view-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Modal content would go here -->
    </div>

    <script>
        function updateSort(value) {
            const [sort, direction] = value.split('-');
            const url = new URL(window.location);
            url.searchParams.set('sort', sort);
            url.searchParams.set('direction', direction);
            window.location = url.toString();
        }
        
        // Additional modern interactions could be added here
    </script>
</x-layouts.store>