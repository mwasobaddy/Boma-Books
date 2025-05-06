<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>

<div class="flex flex-col gap-6 animate-fadeIn">
    <x-auth-header :title="__('Reset your password')" :description="__('We\'ll email you instructions to reset your password')" />

    <!-- Session Status -->
    <x-auth-session-status class="mb-2 text-center px-4 py-3 bg-green-50 text-green-800 dark:bg-green-900/30 dark:text-green-300 rounded-lg" :status="session('status')" />

    <!-- Forgot Password Icon -->
    <div class="flex justify-center my-2">
        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
    </div>

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div class="group">
            <flux:input
                wire:model="email"
                :label="__('Email Address')"
                type="email"
                required
                autofocus
                placeholder="email@example.com"
                class="transition-all focus:ring-2 focus:ring-orange-500/50"
            />
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                {{ __('Enter the email address you used to register') }}
            </p>
        </div>

        <flux:button 
            variant="primary" 
            type="submit" 
            class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 dark:from-orange-600 dark:to-orange-700 dark:hover:from-orange-500 dark:hover:to-orange-600 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
            <span class="flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                {{ __('Send password reset link') }}
            </span>
        </flux:button>
    </form>

    <div class="relative my-2">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="bg-white dark:bg-gray-800 px-2 text-gray-500 dark:text-gray-400">or</span>
        </div>
    </div>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
        <span class="text-gray-600 dark:text-gray-400">{{ __('Remember your password?') }}</span>
        <flux:link :href="route('login')" wire:navigate class="text-orange-600 hover:text-orange-700 dark:text-orange-400 dark:hover:text-orange-300 font-medium transition-colors">
            {{ __('Back to log in') }}
        </flux:link>
    </div>

    <!-- Help Box -->
    <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
        <h4 class="font-medium text-sm text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ __('Need help?') }}
        </h4>
        <p class="text-xs text-gray-600 dark:text-gray-400">
            {{ __('If you don\'t receive an email within a few minutes, check your spam folder or') }}
            <a href="{{ route('store.contact') }}" class="text-orange-600 dark:text-orange-400 hover:underline" wire:navigate>{{ __('contact support') }}</a>.
        </p>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }
    </style>

</div>