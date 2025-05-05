<section class="relative py-20 overflow-hidden bg-gradient-to-br from-orange-500 to-orange-600 dark:from-orange-700 dark:to-orange-800">
    <!-- Background pattern elements -->
    <div class="absolute inset-0 z-0 opacity-10">
        <div class="absolute -left-10 -top-10 w-40 h-40 rounded-full bg-white"></div>
        <div class="absolute right-0 bottom-0 w-64 h-64 rounded-full bg-white"></div>
        <div class="absolute left-1/2 top-1/4 w-20 h-20 rounded-full bg-white"></div>
    </div>
    
    <!-- Main content -->
    <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
            <!-- Text content with improved typography -->
            <div class="w-full lg:w-3/5 text-center lg:text-left">
                <span class="inline-block px-4 py-1 mb-4 text-sm font-medium text-orange-600 bg-white rounded-full">
                    Join Our Community
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight">
                    Discover Your Next <span class="relative inline-block">
                        Favorite Book
                        <span class="absolute bottom-1 left-0 w-full h-2 bg-white opacity-30"></span>
                    </span>
                </h2>
                <p class="text-lg md:text-xl text-white/90 max-w-2xl leading-relaxed">
                    Sign up today for exclusive access to new releases, author interviews, and 
                    special discounts on your favorite books delivered straight to your inbox.
                </p>
            </div>
            
            <!-- Enhanced CTA card -->
            <div class="w-full lg:w-2/5 max-w-md">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8 transform transition-all duration-300 hover:scale-[1.02]">
                    @auth
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Welcome Back!</h3>
                            <a href="#" class="w-full inline-flex items-center justify-center px-6 py-4 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-xl transition duration-150 ease-in-out shadow-md hover:shadow-lg group">
                                Browse Collection
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Join Our Community</h3>
                            <form class="space-y-4">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                                    <input type="email" id="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="youremail@example.com">
                                </div>
                                <a href="{{ route('register') }}" class="w-full inline-block text-center px-6 py-4 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-xl transition duration-150 ease-in-out shadow-md hover:shadow-lg">
                                    Sign Up Now
                                </a>
                                <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-4">
                                    By signing up, you agree to our <a href="#" class="text-orange-600 hover:text-orange-700 dark:text-orange-400 underline">Terms</a> and <a href="#" class="text-orange-600 hover:text-orange-700 dark:text-orange-400 underline">Privacy Policy</a>
                                </p>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    
    <!-- Wave divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" class="w-full h-auto fill-current text-gray-50 dark:text-gray-800">
            <path d="M0,96L80,90.7C160,85,320,75,480,74.7C640,75,800,85,960,85.3C1120,85,1280,75,1360,69.3L1440,64L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z"></path>
        </svg>
    </div>
</section>