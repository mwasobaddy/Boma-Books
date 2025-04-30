<section class="py-16 bg-gradient-to-r from-orange-500 to-orange-600 dark:from-orange-700 dark:to-orange-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="w-full lg:w-2/3 text-center lg:text-left">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Join Our Reading Community</h2>
                <p class="text-lg md:text-xl text-white/90 max-w-2xl">
                    Sign up for exclusive access to new releases, author interviews, and special discounts on your favorite books.
                </p>
            </div>
            <div class="w-full lg:w-1/3 mt-8 lg:mt-0 flex justify-center lg:justify-end">
                @auth
                    <a href="#" class="px-8 py-3 bg-white text-orange-600 hover:bg-orange-50 font-semibold text-lg rounded-lg shadow-lg transition duration-150 ease-in-out inline-flex items-center">
                        Browse Collection
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-orange-600 hover:bg-orange-50 font-semibold text-lg rounded-lg shadow-lg transition duration-150 ease-in-out">
                        Sign Up Now
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>