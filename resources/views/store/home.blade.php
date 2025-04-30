<x-layouts.store>
    <!-- Hero Section -->
    <x-store.hero />

    <!-- Top Read Books Section -->
    <x-store.top-books />

    <!-- Call to Action Section -->
    <x-store.cta />

    <!-- Features/Benefits Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Why Choose Boma Books?</h2>
                <p class="mt-4 text-xl text-gray-600 dark:text-gray-400">Your premier destination for quality literature</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md text-center">
                    <div class="mx-auto h-16 w-16 flex items-center justify-center bg-orange-100 dark:bg-orange-900 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Extensive Collection</h3>
                    <p class="text-gray-600 dark:text-gray-300">Access thousands of titles across all genres, from bestselling authors to indie gems.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md text-center">
                    <div class="mx-auto h-16 w-16 flex items-center justify-center bg-orange-100 dark:bg-orange-900 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Fast Delivery</h3>
                    <p class="text-gray-600 dark:text-gray-300">Enjoy quick shipping with options for express delivery to your doorstep.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md text-center">
                    <div class="mx-auto h-16 w-16 flex items-center justify-center bg-orange-100 dark:bg-orange-900 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Competitive Pricing</h3>
                    <p class="text-gray-600 dark:text-gray-300">Get the best value with our regular discounts, loyalty rewards, and price match guarantee.</p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.store>