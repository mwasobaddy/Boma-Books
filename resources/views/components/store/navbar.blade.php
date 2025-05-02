<nav class="bg-white dark:bg-gray-800 shadow-sm fixed w-full z-50 top-0 sm:top-0 sm:bottom-auto sm:sticky sm:z-50 lg:top-0 lg:bottom-auto lg:sticky"
     x-data="{ isMobile: window.innerWidth < 640 }"
     x-init="window.addEventListener('resize', () => { isMobile = window.innerWidth < 640 })">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-orange-600 dark:text-orange-500">
                        <span class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 4.804A1 1 0 0 1 10.43 4h5.14c.4 0 .75.27.871.646a1 1 0 0 1-.287 1.078l-3 2.5a1 1 0 0 1-1.278 0l-3-2.5A1 1 0 0 1 9 4.804z"/>
                                <path d="M3 7.204A1 1 0 0 1 4.43 6.4h11.14c.4 0 .75.27.871.646a1 1 0 0 1-.287 1.078l-5.57 4.642a1 1 0 0 1-1.278 0L3.287 8.124A1 1 0 0 1 3 7.204z"/>
                                <path d="M3 12.204a1 1 0 0 1 1.43-.804h11.14c.4 0 .75.27.871.646a1 1 0 0 1-.287 1.078l-5.57 4.642a1 1 0 0 1-1.278 0l-5.57-4.642A1 1 0 0 1 3 12.204z"/>
                            </svg>
                            Boma Books
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 ml-10 sm:flex">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-orange-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-700 hover:text-gray-900 hover:border-orange-500 dark:text-gray-200 dark:hover:text-white dark:hover:border-orange-400' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Home
                    </a>
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('shop.index') || request()->routeIs('shop.show') ? 'border-orange-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-700 hover:text-gray-900 hover:border-orange-500 dark:text-gray-200 dark:hover:text-white dark:hover:border-orange-400' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Shop
                    </a>
                    
                    <a href="{{ route('store.contact') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-700 hover:text-gray-900 hover:border-orange-500 dark:text-gray-200 dark:hover:text-white dark:hover:border-orange-400 transition duration-150 ease-in-out">
                        Contact
                    </a>
                </div>
            </div>

            <!-- Cart and Auth Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Favorites Icon -->
                <livewire:favorites.favorite-button />

                <!-- Cart Icon -->
                <livewire:cart.cart-button />
                
                @auth
                    <!-- User Dropdown -->
                    <div class="relative ml-3">
                        <button type="button" class="flex items-center text-sm font-medium text-gray-800 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white focus:outline-none transition duration-150 ease-in-out" id="user-menu-button">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu (Hidden by default) -->
                        <div class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">Dashboard</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">My Orders</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">Log Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                Register
                            </a>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-inner border-t border-gray-200 dark:border-gray-700 flex justify-around py-2 z-50" id="mobile-menu-icons">
        <a href="{{ route('home') }}" class="flex flex-col items-center text-xs {{ request()->routeIs('home') ? 'text-orange-600' : 'text-gray-600 dark:text-gray-300' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5 0h2a2 2 0 002-2V7a2 2 0 00-2-2h-3.5" /></svg>
            Home
        </a>
        <a href="{{ route('shop.index') }}" class="flex flex-col items-center text-xs {{ request()->routeIs('shop.index') || request()->routeIs('shop.show') ? 'text-orange-600' : 'text-gray-600 dark:text-gray-300' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0V7m0 6v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6" /></svg>
            Shop
        </a>
        <div class="flex flex-col items-center text-xs text-gray-600 dark:text-gray-300 relative">
            <livewire:favorites.favorite-button />
            <span class="mt-1">Favs</span>
        </div>
        <div class="flex flex-col items-center text-xs text-gray-600 dark:text-gray-300 relative">
            <livewire:cart.cart-button />
            <span class="mt-1">Cart</span>
        </div>
        <a href="{{ route('store.contact') }}" class="flex flex-col items-center text-xs text-gray-600 dark:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 01-8 0m8 0a4 4 0 00-8 0m8 0V8a4 4 0 00-8 0v4m8 0v4a4 4 0 01-8 0v-4" /></svg>
            Contact
        </a>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // User dropdown toggle
    const userMenu = document.getElementById('user-menu-button');
    if (userMenu) {
        userMenu.addEventListener('click', function() {
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('hidden');
        });
    }

    // Mobile menu toggle
    const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
            
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
        });
    }
    
    // Mobile categories menu (for Alpine.js)
    document.querySelectorAll('[x-data]').forEach(function(el) {
        if (!window.Alpine) {
            // Simple toggle functionality if Alpine.js is not available
            const button = el.querySelector('button');
            if (!button) return;
            
            const content = button.nextElementSibling;
            if (!content) return;
            
            button.addEventListener('click', function() {
                const isOpen = content.style.display !== 'none';
                content.style.display = isOpen ? 'none' : 'block';
                
                // Rotate arrow
                const svg = button.querySelector('svg');
                if (svg) svg.style.transform = isOpen ? '' : 'rotate(180deg)';
            });
        }
    });
});
</script>