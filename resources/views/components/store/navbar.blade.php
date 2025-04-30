<nav class="bg-white dark:bg-gray-800 shadow-sm">
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
                    
                    <!-- Categories Dropdown -->
                    <div class="relative group">
                        <button class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('categories.*') ? 'border-orange-500 text-gray-900 dark:text-white' : 'border-transparent text-gray-700 hover:text-gray-900 hover:border-orange-500 dark:text-gray-200 dark:hover:text-white dark:hover:border-orange-400' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                            Categories
                            <svg class="ml-1 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="absolute z-10 hidden group-hover:block mt-1 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5" id="categories-menu">
                            <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                All Categories
                            </a>
                            <div class="border-t border-gray-200 dark:border-gray-700"></div>
                            <div class="max-h-60 overflow-y-auto py-1" id="categories-dropdown">
                                <!-- Categories will be loaded here via JavaScript -->
                                <div class="text-center py-2 text-sm text-gray-500 dark:text-gray-400">Loading...</div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-700 hover:text-gray-900 hover:border-orange-500 dark:text-gray-200 dark:hover:text-white dark:hover:border-orange-400 transition duration-150 ease-in-out">
                        Contact
                    </a>
                </div>
            </div>

            <!-- Cart and Auth Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative p-2 mr-4 text-gray-600 hover:text-orange-600 dark:text-gray-400 dark:hover:text-orange-500 transition duration-150 ease-in-out group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @php
                        $cart = session('cart', []);
                        $cartCount = count($cart);
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-orange-600 rounded-full">{{ $cartCount }}</span>
                    @endif
                    <span class="hidden group-hover:block absolute top-10 right-0 bg-white dark:bg-gray-700 rounded-md shadow-lg text-sm py-1 px-2 whitespace-nowrap">
                        View Cart
                    </span>
                </a>
                
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
    <div class="hidden sm:hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-orange-500 text-orange-700 bg-orange-50 dark:bg-gray-700 dark:text-orange-300 dark:border-orange-400' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">Home</a>
            <a href="{{ route('shop.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('shop.index') || request()->routeIs('shop.show') ? 'border-orange-500 text-orange-700 bg-orange-50 dark:bg-gray-700 dark:text-orange-300 dark:border-orange-400' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">Shop</a>
            
            <!-- Mobile Categories Menu -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('categories.*') ? 'border-orange-500 text-orange-700 bg-orange-50 dark:bg-gray-700 dark:text-orange-300 dark:border-orange-400' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                    <span>Categories</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" :class="{ 'transform rotate-180': open }">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="pl-5 pr-3" x-show="open" style="display: none;" id="mobile-categories-menu">
                    <a href="{{ route('categories.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                        All Categories
                    </a>
                    <div id="mobile-categories-list" class="max-h-60 overflow-y-auto">
                        <!-- Categories will be loaded here via JavaScript -->
                        <div class="text-center py-2 text-sm text-gray-500 dark:text-gray-400">Loading...</div>
                    </div>
                </div>
            </div>
            
            <a href="#" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">Contact</a>
            <a href="{{ route('cart.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                Cart
                @php
                    $cart = session('cart', []);
                    $cartCount = count($cart);
                @endphp
                @if($cartCount > 0)
                    <span class="inline-flex items-center justify-center ml-2 px-2 py-0.5 text-xs font-bold leading-none text-white bg-orange-600 rounded-full">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
        
        @auth
            <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                            <span class="text-lg font-medium text-gray-700 dark:text-gray-200">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">Dashboard</a>
                    <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">My Orders</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
                <div class="mt-3 space-y-1">
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                            Register
                        </a>
                    @endif
                </div>
            </div>
        @endauth
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
            const content = button.nextElementSibling;
            
            button.addEventListener('click', function() {
                const isOpen = content.style.display !== 'none';
                content.style.display = isOpen ? 'none' : 'block';
                
                // Rotate arrow
                const svg = button.querySelector('svg');
                svg.style.transform = isOpen ? '' : 'rotate(180deg)';
            });
        }
    });
    
    // Load categories for dropdown
    loadCategories();
    
    function loadCategories() {
        fetch('{{ route("api.categories") }}')
            .then(response => response.json())
            .then(categories => {
                const desktopDropdown = document.getElementById('categories-dropdown');
                const mobileDropdown = document.getElementById('mobile-categories-list');
                
                if (desktopDropdown) {
                    desktopDropdown.innerHTML = '';
                    categories.forEach(category => {
                        const link = document.createElement('a');
                        link.href = `/categories/${category.slug}`;
                        link.className = 'flex items-center justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700';
                        link.innerHTML = `
                            ${category.name}
                            <span class="text-xs text-gray-500 dark:text-gray-400">${category.books_count}</span>
                        `;
                        desktopDropdown.appendChild(link);
                    });
                }
                
                if (mobileDropdown) {
                    mobileDropdown.innerHTML = '';
                    categories.forEach(category => {
                        const link = document.createElement('a');
                        link.href = `/categories/${category.slug}`;
                        link.className = 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white';
                        link.textContent = category.name;
                        mobileDropdown.appendChild(link);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
            });
    }
});
</script>