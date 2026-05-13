<?php

use Illuminate\Support\Facades\Route;
use App\Models\Booking;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\WalkerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ProviderApprovalController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function () {

    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');

    return 'Laravel Cache Cleared';

});

Route::get('/db-test', function () {

    return [
        'host' => env('DB_HOST'),
        'database' => env('DB_DATABASE'),
        'username' => env('DB_USERNAME'),
        'password_exists' => env('DB_PASSWORD') ? 'YES' : 'NO',
    ];

});

Route::get('/', function () {
    return 'PawPal Railway Deployment Success!';
});

Route::get('/wallet/add', [WalletController::class, 'showAddFunds'])
    ->name('wallet.add.form');

Route::post('/wallet/add', [WalletController::class, 'addFunds'])
    ->name('wallet.add');

Route::get('/providers', [App\Http\Controllers\ProviderController::class, 'index'])
    ->name('providers.index');


Route::get('/booking-location/{id}', [TrackingController::class, 'getLocation']);

Route::get('/receipt/{id}', function ($id) {

    $booking = Booking::with(['user', 'provider'])->findOrFail($id);

    return view('booking.receipt', compact('booking'));

})->name('receipt.show');

Route::post('/update-location', [TrackingController::class, 'update']);


Route::get('/payment-status/{id}', [App\Http\Controllers\PaymentController::class, 'checkStatus']);

Route::get('/admin/payments', [App\Http\Controllers\AdminPaymentController::class, 'index'])
    ->name('admin.payments');

Route::post('/admin/payments/{id}/approve', [App\Http\Controllers\AdminPaymentController::class, 'approve'])
    ->name('admin.payments.approve');

Route::post('/admin/payments/{id}/reject', [App\Http\Controllers\AdminPaymentController::class, 'reject'])
    ->name('admin.payments.reject');

Route::get('/payment/gcash/{id?}', [PaymentController::class, 'showGcash'])
    ->name('payment.gcash.show');
    
// show payment selection
Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');

// process payment choice
Route::post('/payment/{id}', [PaymentController::class, 'process'])->name('payment.process');

// gcash page
Route::get('/payment/gcash/{id}', [PaymentController::class, 'showGcash'])->name('payment.gcash.show');

// gcash upload
Route::post('/payment/gcash/{id}', [PaymentController::class, 'processGcash'])->name('payment.gcash.upload');
Route::get('/walker/booking/{id}', [WalkerController::class, 'showBooking']);

Route::post('/booking/reject/{id}', [BookingController::class, 'reject'])
    ->name('booking.reject');
    
Route::post('/payment/process/{id}', [PaymentController::class, 'process'])
    ->name('payment.process');

Route::get('/payment/gcash/{id}', function($id){
    return view('payment.gcash', compact('id'));
})->name('payment.gcash.upload');

Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/process/{id}', [PaymentController::class, 'process'])->name('payment.process');


Route::get('/notifications', function(){
    $notifications = auth()->user()->notifications()->latest()->get();
    return view('notifications.index', compact('notifications'));
})->middleware('auth')->name('notifications');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])
    ->name('admin.dashboard');


Route::post('/report/store', [ReportController::class,'store'])
    ->middleware('auth')
    ->name('report.store');

// ADMIN REPORTS
Route::middleware('auth')->group(function(){

    Route::get('/admin/reports', [AdminDashboardController::class,'reports'])
        ->name('admin.reports');

    Route::post('/admin/reports/{id}', [AdminDashboardController::class,'updateReport'])
        ->name('admin.reports.update');

});


Route::get('/report', function () {
    return redirect()->back();
});

Route::get('/provider/reports', [ProviderController::class, 'reports'])
    ->name('provider.reports');
    
Route::post('/report', [ReportController::class, 'store'])
    ->name('report.store');


Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);



Route::get('/review/{booking}', [ReviewController::class, 'create'])
    ->name('review.create');

Route::post('/review', [ReviewController::class, 'store'])
    ->name('review.store');

Route::post('/wallet/pay/{booking}', [WalletController::class, 'payWithWallet'])
    ->name('wallet.pay');

Route::get('/my-bookings', [BookingController::class, 'index'])
    ->name('user.bookings');

// ✅ Approve booking
Route::post('/walker/walks/{id}/approve', [WalkerController::class, 'approve'])
    ->name('walker.walks.approve');

// ✅ Reject booking
Route::post('/walker/walks/{id}/reject', [WalkerController::class, 'rejectWalk'])
    ->name('walker.walks.reject');

    Route::post('/walker/walks/{id}/approve', [WalkerController::class, 'approve'])
    ->name('walker.walks.approve');

Route::post('/walker/walks/{id}/reject', [WalkerController::class, 'rejectWalk'])
    ->name('walker.walks.reject');

Route::post('/walker/walks/{id}/reject', [WalkerController::class, 'rejectWalk'])
    ->name('walker.walks.reject');

Route::get('/walker/booking/{id}', [WalkerController::class, 'showBooking'])
    ->name('walker.booking.show');

Route::get('/my-bookings', [BookingController::class, 'index'])->name('user.bookings');

Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');

Route::get('/wallet', function () {
    return view('wallet.index');
})->name('wallet.page');

Route::post('/wallet/add/{user}', [WalletController::class, 'addFunds'])->name('wallet.add');

Route::post('/wallet/pay/{booking}', [WalletController::class, 'payWithWallet'])->name('wallet.pay');



Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.update');
    
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');
    
Route::post('/wallet/add/{user}', [WalletController::class, 'addFunds'])->name('wallet.add');
Route::post('/wallet/pay/{booking}', [WalletController::class, 'payWithWallet'])->name('wallet.pay');
Route::get('/wallet', function () {
    return view('wallet.index');
})->name('wallet.page');    

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Landing
Route::get('/', fn() => view('landing'));

// Pending Approval Page
Route::get('/pending-approval', fn() => view('auth.pending-approval'))
    ->name('approval.pending');

// Auth
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/admin/login', fn() => view('admin.login'))->name('admin.login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Contact
Route::post('/contact', [ContactController::class, 'store'])->name('contact.send');

// Redirect /admin → dashboard
Route::get('/admin', fn() => redirect()->route('admin.dashboard'));

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES (🔥 WITH BAN PROTECTION)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'not_banned'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        // Providers
        Route::get('/providers/pending', [ProviderApprovalController::class, 'index'])
            ->name('admin.providers.pending');

        Route::post('/providers/{id}/approve', [ProviderApprovalController::class, 'approve'])
            ->name('admin.providers.approve');

        Route::post('/providers/{id}/decline', [ProviderApprovalController::class, 'decline'])
            ->name('admin.providers.decline');

        // Users
        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users');

        // 🔥 USER MANAGEMENT (SECURED HERE)
        Route::post('/users/{id}/ban', [UserController::class, 'ban'])
            ->name('admin.users.ban');

        Route::post('/users/{id}/unban', [UserController::class, 'unban'])
            ->name('admin.users.unban');

        Route::delete('/users/{id}', [UserController::class, 'destroy'])
            ->name('admin.users.delete');

        // Messages
        Route::get('/messages', [ContactController::class, 'index'])
            ->name('admin.messages');

        Route::post('/messages/reply', [ContactController::class, 'reply'])
            ->name('admin.messages.reply');

        // Optional
        Route::get('/sitter-verifications', [UserController::class, 'sitterVerifications']);
        Route::post('/approve/{id}', [UserController::class, 'approve'])->name('admin.approve');
        Route::post('/reject/{id}', [UserController::class, 'reject'])->name('admin.reject');
    });

    // Prevent GET reply
    Route::get('/admin/messages/reply', fn() => redirect('/admin/messages'));
/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard-redirect', function () {

    $user = auth()->user();

    // 👤 USER
    if ($user->role === 'user') {
        return redirect()->route('dashboard');
    }

    // 🐾 PROVIDER
    if ($user->role === 'provider') {

        // 🚶 WALKER
        if ($user->service_type === 'walker') {
            return redirect()->route('walker.dashboard');
        }

        // 🐾 SITTER
        if ($user->service_type === 'sitter') {
            return redirect()->route('provider.dashboard');
        }

    }

    // 🧑‍💼 ADMIN
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

})->middleware('auth');

/*
    /*
    |--------------------------------------------------------------------------
    | CHAT
    |--------------------------------------------------------------------------
    */

    Route::get('/chat/inbox', [ChatController::class, 'inbox'])->name('chat.inbox');
    Route::get('/chat/{userId}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::post('/chat/typing', [ChatController::class, 'typing'])->name('chat.typing');
    
    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:user')->group(function () {

        Route::get('/dashboard', function () {
            $providers = \App\Models\User::where('role', 'provider')
                ->where('status', 'approved')
                ->get();

            return view('dashboard', compact('providers'));
        })->name('dashboard');

        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::post('/book', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/find-providers', [ProviderController::class, 'index'])->name('find.providers');
        Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    });

    /*
    |--------------------------------------------------------------------------
    | PROVIDER (SITTER)
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:provider', 'service:sitter', 'approved'])->group(function () {

        Route::get('/provider/dashboard', [ProviderController::class, 'dashboard'])
            ->name('provider.dashboard');

        Route::post('/provider/update', [ProviderController::class, 'update'])
            ->name('provider.update');

        Route::post('/provider/toggle-availability', [ProviderController::class, 'toggleAvailability'])
            ->name('provider.toggleAvailability');

        Route::get('/provider/bookings', [BookingController::class, 'providerBookings'])
            ->name('provider.bookings');
    });

    /*
    |--------------------------------------------------------------------------
    | WALKER
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:provider', 'service:walker', 'approved'])->group(function () {

     Route::get('/walker/dashboard', [WalkerController::class, 'dashboard'])
    ->name('walker.dashboard');

        Route::get('/walker/walks', [WalkerController::class, 'walks'])
            ->name('walker.walks');

        Route::get('/walker/schedule', [WalkerController::class, 'schedule'])
            ->name('walker.schedule');

        Route::post('/walker/toggle-availability', [WalkerController::class, 'toggleAvailability'])
            ->name('walker.toggleAvailability');
    });

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/users/{id}/penalty', [UserController::class, 'addPenalty'])
    ->name('admin.users.penalty');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])
    ->name('admin.users.edit');

Route::post('/users/{id}/update', [UserController::class, 'update'])
    ->name('admin.users.update');

 // 📋 List services
Route::get('/provider/services', [ProviderController::class, 'services'])
    ->name('provider.services');

// ➕ Store
Route::post('/provider/services', [ProviderController::class, 'storeService'])
    ->name('provider.services.store');

// ✏ Edit form
Route::get('/provider/services/{id}/edit', [ProviderController::class, 'editService'])
    ->name('provider.services.edit');

// 💾 Update
Route::post('/provider/services/{id}/update', [ProviderController::class, 'updateService'])
    ->name('provider.services.update');

Route::delete('/provider/services/{id}', [ProviderController::class, 'deleteService'])
    ->name('provider.services.delete');

Route::post('/walker/walks/{id}/complete', [WalkerController::class, 'completeWalk'])
    ->name('walker.walks.complete');    
