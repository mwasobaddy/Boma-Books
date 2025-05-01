<x-layouts.store>
    <section class="py-16 bg-gray-50 dark:bg-gray-800 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Contact Us</h2>
                <p class="mt-4 text-xl text-gray-600 dark:text-gray-400">We'd love to hear from you! Fill out the form below and we'll get back to you soon.</p>
            </div>
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('store.contact.send') }}" class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md">
                @csrf
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2" for="name">Name</label>
                    <input type="text" id="name" name="name" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-800 dark:text-white" value="{{ old('name') }}">
                    @error('name')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2" for="email">Email</label>
                    <input type="email" id="email" name="email" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-800 dark:text-white" value="{{ old('email') }}">
                    @error('email')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2" for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-800 dark:text-white" value="{{ old('subject') }}">
                    @error('subject')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2" for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-800 dark:text-white">{{ old('message') }}</textarea>
                    @error('message')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="w-full py-3 px-6 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded transition">Send Message</button>
            </form>
        </div>
    </section>
</x-layouts.store>
