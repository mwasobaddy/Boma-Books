<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    return view('store.home');
})->name('home');

// Shop routes (unified with category)
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/categories/{category:slug}', [ShopController::class, 'index'])->name('categories.show');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{cartItemId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{cartItemId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Favorites routes
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/add/{book}', [FavoriteController::class, 'add'])->name('favorites.add');
Route::delete('/favorites/remove/{book}', [FavoriteController::class, 'remove'])->name('favorites.remove');
Route::post('/favorites/toggle/{book}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
Route::post('/favorites/clear', [FavoriteController::class, 'clear'])->name('favorites.clear');

// Contact routes
Route::get('/contact', [ContactController::class, 'show'])->name('store.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('store.contact.send');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
