<x-layouts.store>
    <div class="bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 min-h-screen py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb - Modernized with better design -->
            <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-500 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('shop.index') }}" class="ml-1 text-gray-500 dark:text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors duration-200 md:ml-2" wire:navigate>Shop</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-gray-700 dark:text-gray-300 md:ml-2 font-medium line-clamp-1">{{ $book->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Book Detail Section - Completely modernized layout -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="md:grid md:grid-cols-12 md:gap-0">
                    <!-- Book Image Column -->
                    <div class="md:col-span-5 lg:col-span-4 relative bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
                        <div class="aspect-[2/3] h-full w-full flex items-center justify-center p-6 md:p-8 lg:p-12">
                            <div class="relative w-full h-full max-w-md mx-auto">
                                <!-- Book shadow effect -->
                                <div class="absolute -right-4 bottom-0 w-full h-full bg-gray-800/10 dark:bg-black/20 transform skew-x-6 rounded-lg"></div>
                                
                                <!-- Book cover with raised effect -->
                                <img class="relative w-full h-full object-contain shadow-xl rounded-md transform transition-transform duration-300 hover:scale-105" 
                                     src="{{ $book->cover_image }}" alt="{{ $book->title }}">
                                
                                @if($book->is_featured)
                                    <div class="absolute top-4 right-4 z-10">
                                        <span class="inline-flex items-center bg-orange-500 bg-opacity-95 backdrop-blur-sm text-white text-sm font-medium px-3 py-1.5 rounded-lg shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            Featured
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Book Details Column -->
                    <div class="md:col-span-7 lg:col-span-8 p-6 md:p-8 lg:p-12">
                        <div class="mb-6">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span class="inline-flex items-center bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300 text-xs font-medium px-2.5 py-1 rounded-md">
                                    @if(is_object($book->category))
                                        {{ $book->category->name }}
                                    @else
                                        {{ $book->category }}
                                    @endif
                                </span>
                                
                                <!-- Additional badges could go here -->
                                @if($book->is_featured)
                                    <span class="md:hidden inline-flex items-center bg-orange-50 text-orange-600 dark:bg-orange-900/50 dark:text-orange-300 text-xs font-medium px-2.5 py-1 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Featured
                                    </span>
                                @endif
                            </div>
                            
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white tracking-tight mb-2">{{ $book->title }}</h1>
                            <p class="text-lg text-gray-600 dark:text-gray-400">By <span class="font-medium">{{ $book->author }}</span></p>
                        </div>
                        
                        <div class="flex flex-col md:flex-row md:items-center gap-6 mb-8 pb-8 border-b border-gray-100 dark:border-gray-700">
                            <div>
                                <div class="text-3xl font-bold text-orange-600 dark:text-orange-400">
                                    {{ $book->formatted_price }}
                                </div>
                                <div class="mt-1">
                                    @if($book->stock > 0)
                                        <span class="inline-flex items-center text-green-600 dark:text-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <span>In Stock <span class="text-sm">({{ $book->stock }} available)</span></span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center text-red-600 dark:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                            Out of Stock
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex-grow"></div>
                            
                            @if($book->stock > 0)
                                <div class="w-full md:w-auto">
                                    <livewire:cart.add-to-cart :book="$book" :show-quantity="true" />
                                </div>
                            @else
                                <div class="w-full md:w-auto">
                                    <button disabled class="flex items-center justify-center w-full md:w-auto py-3 px-6 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 font-medium rounded-lg cursor-not-allowed transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Out of Stock
                                    </button>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">This item is currently unavailable</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Book description with improved typography -->
                        <div class="prose dark:prose-invert prose-orange prose-headings:font-semibold prose-a:text-orange-600 dark:prose-a:text-orange-400 max-w-none mb-8">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                About this book
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $book->description }}</p>
                        </div>
                        
                        <!-- Book details/metadata with improved design -->
                        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-5 border border-gray-100 dark:border-gray-700">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Book Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center text-sm">
                                    <span class="text-gray-500 dark:text-gray-400 min-w-32">ISBN:</span>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $book->isbn ?? 'Not available' }}</span>
                                </div>
                                <!-- Additional book metadata could be added here -->
                                <div class="flex items-center text-sm">
                                    <span class="text-gray-500 dark:text-gray-400 min-w-32">Category:</span>
                                    <span class="text-gray-900 dark:text-white font-medium">
                                        @if(is_object($book->category))
                                            {{ $book->category->name }}
                                        @else
                                            {{ $book->category }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Books - Enhanced with modern carousel layout -->
            @if($relatedBooks->count() > 0)
                <div class="mt-16">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                            </svg>
                            Related Books
                        </h2>
                        
                        <!-- Navigation controls for carousel -->
                        <div class="hidden md:flex items-center space-x-2">
                            <button id="prev-related" class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button id="next-related" class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <!-- Scrollable related books container with improved cards -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach($relatedBooks as $relatedBook)
                                <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                                    <a href="{{ route('shop.show', $relatedBook->id) }}" class="block" wire:navigate>
                                        <div class="relative pb-[140%]"> <!-- 7:10 aspect ratio for books -->
                                            <img class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" 
                                                 src="{{ $relatedBook->cover_image }}" 
                                                 alt="{{ $relatedBook->title }}">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors duration-200">{{ $relatedBook->title }}</h3>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">By {{ $relatedBook->author }}</p>
                                            <p class="mt-2 text-orange-600 dark:text-orange-400 font-bold">{{ $relatedBook->formatted_price }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Customer reviews section - New addition -->
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    Customer Reviews
                </h2>
                
                <!-- Review form placeholder -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-8">
                    <p class="text-gray-700 dark:text-gray-300 text-center py-4">Login to leave a review for this book.</p>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 text-white font-medium rounded-lg transition-colors duration-200" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 005 10a6 6 0 0012 0c0-.352-.035-.696-.1-1.028A5 5 0 0010 11z" clip-rule="evenodd" />
                            </svg>
                            Sign in to Review
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick view modal placeholder -->
    <div id="quick-view-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Modal content would go here -->
    </div>
    
    <script>
        // JavaScript for enhanced interactions could be added here
        document.addEventListener('DOMContentLoaded', function() {
            // Carousel navigation functionality would go here
        });
    </script>
</x-layouts.store>