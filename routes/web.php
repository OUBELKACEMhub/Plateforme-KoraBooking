<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdminController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



// Guest Routes 
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    
});


Route::post('/notifications/read', function (Request $request) {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.read')->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

 Route::middleware(['auth', 'customer'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/Aide', [DashboardController::class, 'aide'])->name('aide.index');
    Route::get('/stadiums/{id}', [DashboardController::class, 'show'])->name('stadiums.show');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/reservation-success', function() {
    return view('stadiums.show'); 
})->name('reservation');    
    Route::get('/mes-matchs', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});


Route::middleware(['auth', 'manager'])->prefix('manager')->group(function () {
    

    Route::get('/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
    
   
    Route::get('/terrains', [ManagerController::class, 'afficherMesTerians'])->name('manager.stadiums');
    Route::post('/terrains', [ManagerController::class, 'storeStadium'])->name('stadiums.store');
    Route::put('/terrains/{id}', [ManagerController::class, 'updateStadium'])->name('stadiums.update');
    Route::delete('/terrains/{id}', [ManagerController::class, 'destroyStadium'])->name('stadiums.destroy');

    
    Route::get('/offres', [ManagerController::class, 'getManagerOffers'])->name('manager.offers');
    Route::post('/offres', [OfferController::class, 'storeAndAttachOffer'])->name('manager.offers.store');
    Route::put('/offres/{id}', [ManagerController::class, 'updateOffer'])->name('manager.offers.update');
    Route::delete('/offres/{id}', [ManagerController::class, 'destroyOffer'])->name('manager.offers.destroy');

    
    Route::patch('/reservations/{id}/status', [ManagerController::class, 'updateReservationStatus'])->name('manager.reservations.updateStatus');
    
    
    Route::get('/reviews', [ManagerController::class, 'getManagerReviews'])->name('manager.reviews');

});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/utilisateurs', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/terrains', [AdminController::class, 'stadiums'])->name('admin.stadiums');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');

    Route::patch('/utilisateurs/{id}/ban', [AdminController::class, 'toggleBan'])->name('admin.users.ban');
    
});




