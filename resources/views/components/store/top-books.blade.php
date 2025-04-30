<section class="py-16 bg-white dark:bg-gray-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Top Read Books</h2>
            <p class="mt-4 text-xl text-gray-600 dark:text-gray-400">Discover the most popular books loved by our readers</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Book 1 -->
            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                <div class="relative pb-2/3">
                    <img class="absolute h-full w-full object-cover" src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Book cover">
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Fiction</span>
                        <span class="text-orange-600 dark:text-orange-500 font-bold">${{ number_format(19.99, 2) }}</span>
                    </div>
                    <h3 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white">The Silent Echo</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">By Sarah Johnson</p>
                    <p class="mt-3 text-gray-700 dark:text-gray-300 flex-grow">A captivating story of a woman who discovers mysterious letters in her grandmother's attic, unveiling family secrets spanning generations.</p>
                    @auth
                        <button class="mt-4 w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="mt-4 block text-center w-full border border-orange-600 text-orange-600 dark:border-orange-500 dark:text-orange-500 hover:bg-orange-50 dark:hover:bg-gray-800 font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                            Login to Purchase
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Book 2 -->
            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                <div class="relative pb-2/3">
                    <img class="absolute h-full w-full object-cover" src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Book cover">
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start">
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Non-Fiction</span>
                        <span class="text-orange-600 dark:text-orange-500 font-bold">${{ number_format(24.99, 2) }}</span>
                    </div>
                    <h3 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white">Beyond Horizons</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">By Michael Torres</p>
                    <p class="mt-3 text-gray-700 dark:text-gray-300 flex-grow">An inspiring memoir of exploration and discovery as the author journeys through remote regions of the world, challenging conventional wisdom.</p>
                    @auth
                        <button class="mt-4 w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="mt-4 block text-center w-full border border-orange-600 text-orange-600 dark:border-orange-500 dark:text-orange-500 hover:bg-orange-50 dark:hover:bg-gray-800 font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                            Login to Purchase
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Book 3 -->
            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                <div class="relative pb-2/3">
                    <img class="absolute h-full w-full object-cover" src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Book cover">
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start">
                        <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Science Fiction</span>
                        <span class="text-orange-600 dark:text-orange-500 font-bold">${{ number_format(18.50, 2) }}</span>
                    </div>
                    <h3 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white">Quantum Paradox</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">By Elena Rodriguez</p>
                    <p class="mt-3 text-gray-700 dark:text-gray-300 flex-grow">In a world where reality is malleable, a physicist discovers how to manipulate the quantum field, with unintended consequences for humanity.</p>
                    @auth
                        <button class="mt-4 w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="mt-4 block text-center w-full border border-orange-600 text-orange-600 dark:border-orange-500 dark:text-orange-500 hover:bg-orange-50 dark:hover:bg-gray-800 font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                            Login to Purchase
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Book 4 -->
            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                <div class="relative pb-2/3">
                    <img class="absolute h-full w-full object-cover" src="https://images.unsplash.com/photo-1495640452828-3df6795cf69b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Book cover">
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start">
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Historical</span>
                        <span class="text-orange-600 dark:text-orange-500 font-bold">${{ number_format(22.75, 2) }}</span>
                    </div>
                    <h3 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white">Whispers of Antiquity</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">By Daniel Chen</p>
                    <p class="mt-3 text-gray-700 dark:text-gray-300 flex-grow">A meticulously researched historical novel weaving together the lives of ordinary people against the backdrop of ancient civilization.</p>
                    @auth
                        <button class="mt-4 w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="mt-4 block text-center w-full border border-orange-600 text-orange-600 dark:border-orange-500 dark:text-orange-500 hover:bg-orange-50 dark:hover:bg-gray-800 font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                            Login to Purchase
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="#" class="inline-flex items-center px-6 py-3 border border-orange-600 dark:border-orange-500 text-orange-600 dark:text-orange-500 hover:bg-orange-600 hover:text-white dark:hover:bg-orange-500 dark:hover:text-white font-medium text-base rounded-lg transition duration-150 ease-in-out">
                Browse All Books
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</section>