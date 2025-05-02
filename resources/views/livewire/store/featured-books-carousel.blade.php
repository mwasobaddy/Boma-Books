<div class="relative bg-gray-100 rounded-lg overflow-hidden shadow-md" wire:poll.{{ $autoSlide ? $slideInterval : 'none' }}="nextSlide">
    <!-- Carousel images -->
    <div class="relative h-96">
        @forelse($featuredBooks as $index => $book)
            <div class="absolute inset-0 transition-opacity duration-500 ease-in-out {{ $activeIndex === $index ? 'opacity-100' : 'opacity-0' }}">
                <img src="{{ $book->cover_image ?? asset('images/book-placeholder.jpg') }}" 
                     alt="{{ $book->title }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6 text-white">
                    <h2 class="text-2xl font-bold mb-2">{{ $book->title }}</h2>
                    <p class="mb-2">By {{ $book->author }}</p>
                    <div class="flex items-center space-x-4 mt-4">
                        <span class="text-xl font-bold">${{ number_format($book->price, 2) }}</span>
                        <a href="{{ route('store.shop.show', $book) }}" 
                           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="flex items-center justify-center h-full">
                <p class="text-gray-500">No featured books available</p>
            </div>
        @endforelse
    </div>

    <!-- Navigation buttons -->
    <button wire:click="previousSlide" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 rounded-full p-2 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    <button wire:click="nextSlide" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 rounded-full p-2 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>

    <!-- Indicators -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        @foreach($featuredBooks as $index => $book)
            <button wire:click="setActiveSlide({{ $index }})" 
                    class="w-3 h-3 rounded-full {{ $activeIndex === $index ? 'bg-blue-600' : 'bg-gray-300 hover:bg-gray-400' }}">
            </button>
        @endforeach
    </div>
</div>
