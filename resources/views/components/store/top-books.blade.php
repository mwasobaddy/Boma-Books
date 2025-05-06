<section class="py-16 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header with Animation -->
        <div class="text-center mb-12 reveal-animation" x-data="{show: false}" x-intersect="show = true" x-bind:class="{'opacity-100 translate-y-0': show, 'opacity-0 translate-y-4': !show}" class="transition-all duration-700 ease-out">
            <span class="inline-block px-3 py-1 text-sm font-medium text-orange-700 dark:text-orange-300 bg-orange-100 dark:bg-orange-900/30 rounded-full mb-3">Top Picks</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                <span class="relative">
                    <span class="relative z-10">Top Read Books</span>
                    <span class="absolute bottom-1 left-0 w-full h-3 bg-orange-200 dark:bg-orange-800/40 -z-10 rounded"></span>
                </span>
            </h2>
            <p class="mt-4 text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Discover the most popular books loved by our readers this month</p>
            
            <!-- Reading statistics -->
            <div class="flex flex-wrap justify-center gap-8 mt-8">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">5,200+</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Books Read</p>
                    </div>
                </div>
                
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">1,800+</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Reviews</p>
                    </div>
                </div>
                
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">$450K</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Monthly Sales</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Books Carousel Component -->
        <div class="relative rounded-2xl shadow-2xl overflow-hidden" x-data="{show: false}" x-intersect="show = true" x-bind:class="{'opacity-100 translate-y-0': show, 'opacity-0 translate-y-8': !show}" class="transition-all duration-1000 ease-out delay-300">
            <livewire:books.featured-books-carousel />
        </div>

        <!-- Categories and Browsing Section -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Popular Categories -->
            <div class="md:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transform transition-all duration-300 hover:shadow-xl">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Popular Categories</h3>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach(['Fiction', 'Non-Fiction', 'Biography', 'Science', 'Fantasy', 'Romance'] as $category)
                        <a href="{{ route('shop.index', ['category' => $category]) }}" class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors duration-300 group" wire:navigate>
                            <span class="font-medium text-gray-800 dark:text-gray-200 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">{{ $category }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-orange-500 dark:group-hover:text-orange-400 transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Newsletter Sign Up -->
            <div class="bg-gradient-to-br from-orange-500 to-pink-600 dark:from-orange-600 dark:to-pink-700 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-xl font-bold">Stay Updated</h3>
                </div>
                <p class="mb-4 text-white/90">Get notified about new releases and special offers!</p>
                <form class="space-y-3">
                    <div>
                        <input type="email" placeholder="Your email address" class="w-full px-4 py-2 rounded-lg bg-white/20 backdrop-blur-sm border border-white/30 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50">
                    </div>
                    <button type="submit" class="w-full px-4 py-2 bg-white text-orange-600 font-medium rounded-lg hover:bg-white/90 transition-colors duration-300 flex items-center justify-center">
                        Subscribe
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Browse All Books Button -->
        <div class="mt-12 text-center" x-data="{show: false}" x-intersect="show = true" x-bind:class="{'opacity-100 translate-y-0': show, 'opacity-0 translate-y-4': !show}" class="transition-all duration-700 ease-out delay-500">
            <a href="{{ route('shop.index') }}" class="inline-flex items-center px-8 py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium text-lg rounded-xl shadow-lg hover:bg-gray-800 dark:hover:bg-gray-100 transform hover:-translate-y-1 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-gray-500/20 dark:focus:ring-white/20" wire:navigate>
                Browse All Books
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
            
            <!-- Book count badge -->
            <div class="inline-block ml-4 px-3 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 text-sm font-medium rounded-full">
                2,500+ Books Available
            </div>
        </div>
    </div>
</section>