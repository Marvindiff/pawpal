<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:provider'])->group(function () {
    Route::get('/provider/dashboard', [ProviderController::class, 'dashboard'])->name('provider.dashboard');
    Route::post('/provider/toggle-availability', [ProviderController::class, 'toggleAvailability'])->name('provider.toggleAvailability');
    Route::get('/provider/bookings', [BookingController::class, 'providerBookings'])->name('provider.bookings');
    Route::get('/provider/services', [ServiceController::class, 'index'])->name('provider.services');
});
// Landing Page
Route::get('/', function () {
    return view('landing');
});

// Auth routes
Auth::routes();

// ==========================
// USER DASHBOARD / PET OWNER
// ==========================
Route::middleware(['auth', 'role:user'])->group(function () {

    // User dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // View bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

    // Book a provider
    Route::post('/book', [BookingController::class, 'store'])->name('booking.store');

    // Find providers
    Route::get('/find-providers', [ProviderController::class, 'index'])->name('find.providers');
});

// ==========================
// PROVIDER DASHBOARD
// ==========================
Route::middleware(['auth', 'role:provider'])->group(function () {

    // Provider dashboard
    Route::get('/provider/dashboard', [ProviderController::class, 'dashboard'])->name('provider.dashboard');

    // Update profile / toggle availability
    Route::post('/provider/update', [ProviderController::class, 'update'])->name('provider.update');
    Route::post('/provider/toggle-availability', [ProviderController::class, 'toggleAvailability'])
        ->name('provider.toggleAvailability');

    // Provider bookings
    Route::get('/provider/bookings', [BookingController::class, 'providerBookings'])->name('provider.bookings');

    // Approve/reject bookings
    Route::post('/booking/{id}/approve', [BookingController::class, 'approve'])->name('booking.approve');
    Route::post('/booking/{id}/reject', [BookingController::class, 'reject'])->name('booking.reject');

    // Manage services
    Route::get('/provider/services', [ServiceController::class, 'index'])->name('provider.services');
    Route::post('/provider/services', [ServiceController::class, 'store'])->name('provider.services.store');
});

// ==========================
// PROFILE ROUTES
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});