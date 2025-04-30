<x-layouts.store>
    <div class="bg-gray-50 dark:bg-gray-900 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('categories.index') }}" class="ml-1 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 md:ml-2">Categories</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-gray-500 dark:text-gray-400 md:ml-2 font-medium">{{ $category->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Category Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Categories</h3>
                        <ul class="space-y-2">
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('categories.show', $cat) }}" 
                                       class="flex items-center justify-between py-2 px-3 rounded-md {{ $cat->id === $category->id ? 'bg-orange-50 text-orange-600 dark:bg-gray-700 dark:text-orange-500' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                                        <span>{{ $cat->name }}</span>
                                        <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs font-medium px-2 py-0.5 rounded">{{ $cat->books_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Category Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $category->name }}</h1>
                        @if($category->description)
                            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">{{ $category->description }}</p>
                        @endif
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $books->total() }} {{ Str::plural('book', $books->total()) }} found</p>
                    </div>

                    <!-- Sorting and Filters -->
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0">
                        <div>
                            <label for="sort" class="text-sm font-medium text-gray-600 dark:text-gray-400">Sort by:</label>
                            <select id="sort" class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2">
                                <option value="created_at-desc" {{ request('sort') == 'created_at' && request('direction') == 'desc' ? 'selected' : '' }}>Newest</option>
                                <option value="created_at-asc" {{ request('sort') == 'created_at' && request('direction') == 'asc' ? 'selected' : '' }}>Oldest</option>
                                <option value="title-asc" {{ request('sort') == 'title' && request('direction') == 'asc' ? 'selected' : '' }}>Title (A-Z)</option>
                                <option value="title-desc" {{ request('sort') == 'title' && request('direction') == 'desc' ? 'selected' : '' }}>Title (Z-A)</option>
                                <option value="price-asc" {{ request('sort') == 'price' && request('direction') == 'asc' ? 'selected' : '' }}>Price (Low to High)</option>
                                <option value="price-desc" {{ request('sort') == 'price' && request('direction') == 'desc' ? 'selected' : '' }}>Price (High to Low)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Books Grid -->
                    @if($books->count() > 0)
                        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($books as $book)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                    <a href="{{ route('shop.show', $book->slug) }}">
                                        <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-book-cover.png') }}" alt="{{ $book->title }}" class="w-full h-64 object-cover">
                                    </a>
                                    <div class="p-5">
                                        <a href="{{ route('shop.show', $book->slug) }}">
                                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $book->title }}</h5>
                                        </a>
                                        <p class="text-gray-600 dark:text-gray-400">{{ $book->author }}</p>
                                        <div class="flex items-center my-2">
                                            <!-- Star Rating -->
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $book->rating)
                                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between mt-4">
                                            <span class="text-xl font-bold text-gray-900 dark:text-white">${{ number_format($book->price, 2) }}</span>
                                            <button 
                                                data-book-id="{{ $book->id }}"
                                                data-book-title="{{ $book->title }}"
                                                data-book-price="{{ $book->price }}"
                                                data-book-image="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-book-cover.png') }}"
                                                class="add-to-cart px-3 py-2 text-sm font-medium text-white bg-orange-600 rounded-lg hover:bg-orange-700 focus:ring-4 focus:ring-orange-300">
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $books->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            <h3 class="mt-2 text-xl font-medium text-gray-900 dark:text-white">No books found</h3>
                            <p class="mt-1 text-gray-500 dark:text-gray-400">We couldn't find any books in this category. Please check back later.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Handle sorting
        document.getElementById('sort').addEventListener('change', function() {
            const value = this.value.split('-');
            const sort = value[0];
            const direction = value[1];
            
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sort);
            url.searchParams.set('direction', direction);
            
            window.location.href = url.toString();
        });
        
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const bookId = this.getAttribute('data-book-id');
                const bookTitle = this.getAttribute('data-book-title');
                const bookPrice = this.getAttribute('data-book-price');
                const bookImage = this.getAttribute('data-book-image');
                
                // Send AJAX request to add item to cart
                fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        book_id: bookId,
                        quantity: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success notification
                        const notification = document.createElement('div');
                        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 animate-fade-in-out flex items-center';
                        notification.innerHTML = `
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            ${data.message}
                        `;
                        document.body.appendChild(notification);
                        
                        // Update cart count in navbar
                        const cartCount = document.querySelector('.cart-count');
                        if (cartCount) {
                            cartCount.textContent = data.cartCount;
                            cartCount.classList.remove('hidden');
                        }
                        
                        // Remove notification after 3 seconds
                        setTimeout(() => {
                            notification.remove();
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error adding to cart:', error);
                });
            });
        });
    </script>
    @endpush
</x-layouts.store>