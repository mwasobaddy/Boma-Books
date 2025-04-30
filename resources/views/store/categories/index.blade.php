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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-gray-500 dark:text-gray-400 md:ml-2 font-medium">Categories</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Browse Categories</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Find your favorite books by category</p>
            </div>

            <!-- Categories Grid -->
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h2>
                                <span class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 text-sm font-medium px-2.5 py-0.5 rounded">{{ $category->books_count }}</span>
                            </div>
                            
                            @if($category->description)
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">{{ $category->description }}</p>
                            @endif
                            
                            <div class="flex items-center text-orange-600 dark:text-orange-500 group">
                                <span class="text-sm font-medium">View Books</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.store>