<?php

use App\Models\Book;
use Livewire\Volt\Component;

new class extends Component {
    // Properties
    public $featuredBooks = [];
    public $currentSlide = 0;
    public $totalSlides = 0;
    public $autoplayInterval = 6000; // 6 seconds between slides for better user experience
    public $isPaused = false;
    public $isTransitioning = false; // Track transition state for animations

    // Initialize component
    public function mount()
    {
        // Get only featured books with eager loading for performance
        $this->featuredBooks = Book::featured()
                                  ->published()
                                  ->with(['category']) // Assuming there might be an author relationship
                                  ->take(8) // Limit to 8 books for optimal performance and UX
                                  ->get();
        $this->totalSlides = $this->featuredBooks->count() > 0 ? ceil($this->featuredBooks->count() / 2) : 0;
    }

    // Navigate to next slide with transition handling
    public function nextSlide()
    {
        if ($this->isTransitioning) return;
        
        $this->isTransitioning = true;
        $this->currentSlide = ($this->currentSlide + 1) % max(1, $this->totalSlides);
        
        // Reset transition state after animation completes
        $this->dispatch('slide-changed');
    }
    
    // Navigate to previous slide with transition handling
    public function prevSlide()
    {
        if ($this->isTransitioning) return;
        
        $this->isTransitioning = true;
        $this->currentSlide = ($this->currentSlide - 1 + max(1, $this->totalSlides)) % max(1, $this->totalSlides);
        
        // Reset transition state after animation completes
        $this->dispatch('slide-changed');
    }
    
    // Go to a specific slide
    public function goToSlide($index)
    {
        if ($this->isTransitioning || $this->currentSlide === $index) return;
        
        $this->isTransitioning = true;
        $this->currentSlide = $index;
        
        // Reset transition state after animation completes
        $this->dispatch('slide-changed');
    }
    
    // Pause autoplay
    public function pause()
    {
        $this->isPaused = true;
    }
    
    // Resume autoplay
    public function resume()
    {
        $this->isPaused = false;
    }
}; ?>

<div 
    x-data="{
        autoplay: true,
        touchStartX: 0,
        touchEndX: 0,
        init() {
            this.autoplayTimer = setInterval(() => {
                if (this.autoplay && !$wire.isPaused) {
                    $wire.nextSlide();
                }
            }, {{ $autoplayInterval }});
            
            this.$watch('$wire.isTransitioning', value => {
                if (value) {
                    // Reset transition state after animation completes
                    setTimeout(() => {
                        $wire.isTransitioning = false;
                    }, 500); // Match this to the CSS transition duration
                }
            });
        },
        pauseAutoplay() {
            this.autoplay = false;
            $wire.pause();
        },
        resumeAutoplay() {
            this.autoplay = true;
            $wire.resume();
        },
        handleTouchStart(e) {
            this.touchStartX = e.changedTouches[0].screenX;
        },
        handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].screenX;
            if (this.touchStartX - this.touchEndX > 50) {
                $wire.nextSlide(); // Swipe left
            } else if (this.touchEndX - this.touchStartX > 50) {
                $wire.prevSlide(); // Swipe right
            }
        }
    }"
    @mouseover="pauseAutoplay()"
    @mouseleave="resumeAutoplay()"
    @touchstart="handleTouchStart"
    @touchend="handleTouchEnd"
    class="relative w-full overflow-hidden bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 rounded-2xl shadow-lg"
>
    <!-- Header with icon -->
    <div class="flex items-center justify-center pt-10 pb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500 dark:text-orange-400 mr-3" viewBox="0 0 20 20" fill="currentColor">
            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
        </svg>
        <div>
            <h2 class="text-3xl md:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-pink-600 dark:from-orange-400 dark:to-pink-500">Featured Books</h2>
            <p class="text-sm md:text-base text-gray-600 dark:text-gray-400 mt-1">Handpicked selections just for you</p>
        </div>
    </div>

    <!-- Carousel -->
    <div class="relative px-4 md:px-8 pb-16">
        <!-- Slides Container -->
        <div class="overflow-hidden">
            <div 
                class="flex transition-transform duration-500 ease-out"
                style="transform: translateX(-{{ $currentSlide * 100 }}%);"
                @slide-changed.window="$wire.isTransitioning = false"
            >
                @if($featuredBooks->count() > 0)
                    @for($slideIndex = 0; $slideIndex < $totalSlides; $slideIndex++)
                        <div class="w-full flex-shrink-0 snap-center">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
                                @foreach($featuredBooks->slice($slideIndex * 2, 2) as $book)
                                    <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden transform transition duration-300 hover:scale-[1.02] hover:shadow-xl shadow-md">
                                        <!-- Ribbon for new releases (example of conditional design element) -->
                                        @if($book->created_at && $book->created_at->isAfter(now()->subDays(30)))
                                            <div class="absolute top-0 right-0 z-10">
                                                <div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg shadow-md">
                                                    NEW
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <div class="flex flex-col sm:flex-row h-full">
                                            <!-- Book Cover with Animated Hover -->
                                            <div class="relative sm:w-1/3 h-52 sm:h-auto overflow-hidden">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-40 group-hover:opacity-30 transition-opacity z-10"></div>
                                                <img 
                                                    class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-110" 
                                                    src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-book-cover.png') }}" 
                                                    alt="{{ $book->title }}"
                                                    loading="lazy"
                                                >
                                                <!-- Featured badge with animation -->
                                                <div class="absolute top-3 left-3 z-10">
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-500 text-white shadow-lg group-hover:bg-orange-600 transition-all duration-300 group-hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        Featured
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <!-- Book Details -->
                                            <div class="flex flex-col p-5 sm:w-2/3 justify-between">
                                                <div>
                                                    <!-- Category -->
                                                    <div class="flex justify-between items-center mb-2">
                                                        <span class="bg-blue-50 text-blue-700 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                                                            {{ $book->category->name ?? 'Uncategorized' }}
                                                        </span>
                                                        <span class="text-orange-600 dark:text-orange-400 font-bold">{{ $book->formatted_price }}</span>
                                                    </div>
                                                    
                                                    <!-- Title and Author -->
                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">
                                                        {{ $book->title }}
                                                    </h3>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                        By {{ $book->author }}
                                                    </p>
                                                    
                                                    <!-- Description with line clamp -->
                                                    <p class="mt-3 text-sm text-gray-700 dark:text-gray-300 line-clamp-3">
                                                        {{ $book->description }}
                                                    </p>
                                                </div>
                                                
                                                <!-- Action Buttons with Hover Effects -->
                                                <div class="mt-4 flex items-center space-x-2">
                                                    @if($book->stock > 0)
                                                        <livewire:cart.add-to-cart 
                                                            :key="'carousel-add-to-cart-'.$book->id" 
                                                            :book="$book" 
                                                            :show-quantity="false"
                                                        />
                                                        <button class="flex-shrink-0 group-hover:bg-gray-100 dark:group-hover:bg-gray-700 p-2 rounded-full transition-colors ease-in-out" title="Add to Wishlist">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                            </svg>
                                                        </button>
                                                    @else
                                                        <button disabled class="flex-grow bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium py-2 px-4 rounded-lg cursor-not-allowed flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                            </svg>
                                                            Out of Stock
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endfor
                @else
                    <div class="w-full flex-shrink-0 flex items-center justify-center py-20">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <p class="mt-4 text-xl text-gray-600 dark:text-gray-400">No featured books available at the moment.</p>
                            <button class="mt-4 px-6 py-2 bg-gradient-to-r from-orange-500 to-pink-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-pink-700 focus:ring-4 focus:ring-orange-200 dark:focus:ring-orange-800 transition-all">
                                Browse All Books
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Modern Navigation Buttons with Hover Effects -->
        @if($totalSlides > 1)
            <button 
                wire:click="prevSlide"
                class="absolute top-1/2 left-2 md:left-5 transform -translate-y-1/2 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm p-2 md:p-3 rounded-full shadow-lg hover:bg-white dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:focus:ring-orange-400 transition-all duration-300 group"
                aria-label="Previous slide"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-gray-700 dark:text-gray-300 group-hover:text-orange-500 dark:group-hover:text-orange-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button 
                wire:click="nextSlide"
                class="absolute top-1/2 right-2 md:right-5 transform -translate-y-1/2 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm p-2 md:p-3 rounded-full shadow-lg hover:bg-white dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:focus:ring-orange-400 transition-all duration-300 group"
                aria-label="Next slide"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-gray-700 dark:text-gray-300 group-hover:text-orange-500 dark:group-hover:text-orange-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        @endif

        <!-- Modern Indicators with Active Animation -->
        @if($totalSlides > 1)
            <div class="absolute bottom-4 left-0 right-0">
                <div class="flex justify-center space-x-2">
                    @for($i = 0; $i < $totalSlides; $i++)
                        <button 
                            wire:click="goToSlide({{ $i }})"
                            class="w-2 md:w-2.5 h-2 md:h-2.5 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 {{ $currentSlide === $i ? 'bg-orange-500 dark:bg-orange-400 w-6 md:w-8' : 'bg-gray-300 dark:bg-gray-600 hover:bg-orange-300 dark:hover:bg-orange-700' }}"
                            aria-label="Go to slide {{ $i + 1 }}"
                        ></button>
                    @endfor
                </div>
            </div>
        @endif
    </div>
    
    <!-- Browse All Books Button -->
    <div class="relative pb-10 text-center">
        <a href="{{ route('shop.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-br from-orange-500 to-pink-600 text-white font-medium rounded-lg shadow-md hover:from-orange-600 hover:to-pink-700 focus:ring-4 focus:ring-orange-200 dark:focus:ring-orange-800 transition-all duration-300 transform hover:-translate-y-0.5">
            Browse All Books
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>