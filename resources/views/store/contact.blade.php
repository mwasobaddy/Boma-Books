<x-layouts.store>
    <!-- Hero Banner with Background Image -->
    <div class="relative bg-orange-50 dark:bg-gray-900">
        <div class="absolute inset-0 z-0 opacity-20 dark:opacity-10">
            <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&q=80" alt="Bookstore Background" class="w-full h-full object-cover">
        </div>
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8 text-center">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 dark:text-white mb-2 tracking-tight">Get in Touch</h1>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-600 dark:text-gray-300">We'd love to hear from you. Let us know how we can help with your literary journey.</p>
        </div>
    </div>

    <section class="py-12 lg:py-20 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                <!-- Two-column layout for larger screens -->
                <div class="flex flex-col lg:flex-row gap-12">
                    <!-- Left Column: About + Contact Info -->
                    <div class="lg:w-2/5">
                        <!-- About Card -->
                        <div class="bg-white dark:bg-gray-700 rounded-xl shadow-sm border border-gray-100 dark:border-gray-600 p-6 mb-8">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-orange-100 dark:bg-orange-900 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600 dark:text-orange-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">About Boma Books</h2>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Founded by passionate readers, our mission is to inspire, educate, and connect communities through the power of stories. We believe in the magic of books to transform lives.
                            </p>
                            <div class="flex items-center mt-6">
                                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=150&q=80" alt="Boma Books Store" class="w-24 h-24 rounded-lg object-cover">
                                <div class="ml-4">
                                    <span class="block text-sm font-semibold text-gray-500 dark:text-gray-400">Est. 2020</span>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Your premier destination for quality books</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Info Card -->
                        <div class="bg-orange-50 dark:bg-gray-700/50 rounded-xl shadow-sm p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ways to Reach Us</h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Email</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">contact@bomabooks.com</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Phone</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">(555) 123-4567</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Address</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">123 Book Lane, Literary District<br>Novel City, NC 12345</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Social Media Links -->
                            <div class="mt-6 flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors">
                                    <span class="sr-only">Instagram</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors">
                                    <span class="sr-only">Twitter</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Contact Form -->
                    <div class="lg:w-3/5">
                        <div class="bg-white dark:bg-gray-700 rounded-xl border border-gray-100 dark:border-gray-600 shadow-sm overflow-hidden">
                            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-600 bg-gray-50 dark:bg-gray-800/50">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Send us a message</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">We'll get back to you within 24 hours</p>
                            </div>
                            
                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="m-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ session('success') }}</span>
                                </div>
                            @endif
                            
                            <!-- Contact Form -->
                            <form method="POST" action="{{ route('store.contact.send') }}" class="p-6">
                                @csrf
                                <div class="space-y-6">
                                    <!-- Name Field -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <input type="text" id="name" name="name" required 
                                                class="block w-full pl-10 py-3 border-gray-200 dark:border-gray-600 rounded-md focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 transition-colors" 
                                                placeholder="Your name" 
                                                value="{{ old('name') }}">
                                        </div>
                                        @error('name')<div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>@enderror
                                    </div>
                                    
                                    <!-- Email Field -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                </svg>
                                            </div>
                                            <input type="email" id="email" name="email" required 
                                                class="block w-full pl-10 py-3 border-gray-200 dark:border-gray-600 rounded-md focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 transition-colors" 
                                                placeholder="your.email@example.com" 
                                                value="{{ old('email') }}">
                                        </div>
                                        @error('email')<div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>@enderror
                                    </div>
                                    
                                    <!-- Subject Field -->
                                    <div>
                                        <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Subject</label>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                                </svg>
                                            </div>
                                            <input type="text" id="subject" name="subject" required 
                                                class="block w-full pl-10 py-3 border-gray-200 dark:border-gray-600 rounded-md focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 transition-colors" 
                                                placeholder="What's this about?" 
                                                value="{{ old('subject') }}">
                                        </div>
                                        @error('subject')<div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>@enderror
                                    </div>
                                    
                                    <!-- Message Field -->
                                    <div>
                                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Message</label>
                                        <div class="relative rounded-md shadow-sm">
                                            <textarea id="message" name="message" rows="5" required 
                                                class="block w-full p-4 border-gray-200 dark:border-gray-600 rounded-md focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 transition-colors" 
                                                placeholder="Tell us how we can help you">{{ old('message') }}</textarea>
                                        </div>
                                        @error('message')<div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>@enderror
                                    </div>
                                    
                                    <!-- Submit Button -->
                                    <div>
                                        <button type="submit" 
                                            class="w-full inline-flex items-center justify-center py-3 px-6 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                            </svg>
                                            Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section (New Addition) -->
    <section class="py-12 bg-orange-50 dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Frequently Asked Questions</h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Here are some common questions our customers ask</p>
            </div>
            
            <div class="grid gap-6 md:grid-cols-2">
                <!-- FAQ Item 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Do you offer store pickup?</h3>
                    <p class="text-gray-600 dark:text-gray-300">Yes! You can select "Store Pickup" at checkout and collect your books at our physical location during business hours.</p>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">What are your shipping rates?</h3>
                    <p class="text-gray-600 dark:text-gray-300">We offer free shipping on orders over $35. For orders under $35, shipping rates start at $4.99 depending on location.</p>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Can I return books I've purchased?</h3>
                    <p class="text-gray-600 dark:text-gray-300">We accept returns within 30 days of purchase. Books must be in original condition with receipt.</p>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Do you buy used books?</h3>
                    <p class="text-gray-600 dark:text-gray-300">Yes, we do buy select used books. Please bring them to our store for evaluation during business hours.</p>
                </div>
            </div>
            
            <div class="text-center mt-8">
                <p class="text-gray-600 dark:text-gray-400">Still have questions? <a href="#" class="text-orange-600 dark:text-orange-400 font-medium hover:text-orange-700 dark:hover:text-orange-300">Check our help center</a> or contact us directly.</p>
            </div>
        </div>
    </section>
</x-layouts.store>