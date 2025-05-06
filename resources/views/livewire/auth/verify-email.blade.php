<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6 animate-fadeIn">
    <x-auth-header
        :title="__('Verify your email')"
        :description="__('Thanks for signing up! Before you get started, please verify your email address')"
    />

    <!-- Email Verification Icon -->
    <div class="flex justify-center my-4">
        <div class="p-3 bg-amber-100 dark:bg-amber-900/30 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <div class="p-5 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-lg shadow-sm">
        <flux:text class="text-center">
            {{ __('Please verify your email address by clicking on the link we just emailed to you.') }}
        </flux:text>

        @if (session('status') == 'verification-link-sent')
            <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-100 dark:border-green-800/30 rounded-lg">
                <flux:text class="text-center font-medium !text-green-600 !dark:text-green-400 flex items-center justify-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('A new verification link has been sent to your email address.') }}
                </flux:text>
            </div>
        @endif

        <div class="mt-6 flex flex-col items-center justify-between space-y-3">
            <flux:button 
                wire:click="sendVerification" 
                variant="primary" 
                class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 dark:from-amber-600 dark:to-amber-700 dark:hover:from-amber-500 dark:hover:to-amber-600 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                <span class="flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    {{ __('Resend verification email') }}
                </span>
            </flux:button>

            <div class="relative my-4 w-full">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="bg-white dark:bg-gray-800 px-2 text-gray-500 dark:text-gray-400">or</span>
                </div>
            </div>

            <flux:link class="text-sm cursor-pointer flex items-center gap-1 text-orange-600 hover:text-orange-700 dark:text-orange-400 dark:hover:text-orange-300 transition-colors" wire:click="logout">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                {{ __('Log out') }}
            </flux:link>
        </div>
    </div>

    <!-- Help Box -->
    <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
        <h4 class="font-medium text-sm text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ __('Didn\'t receive the email?') }}
        </h4>
        <ul class="text-xs text-gray-600 dark:text-gray-400 space-y-1 list-disc list-inside">
            <li>{{ __('Check your spam or junk mail folder') }}</li>
            <li>{{ __('Make sure you\'ve entered the correct email address') }}</li>
            <li>{{ __('Try resending the verification email') }}</li>
            <li>{{ __('If problems persist,') }} <a href="{{ route('store.contact') }}" class="text-orange-600 dark:text-orange-400 hover:underline" wire:navigate>{{ __('contact support') }}</a></li>
        </ul>
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
