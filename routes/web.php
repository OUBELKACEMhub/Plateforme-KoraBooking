<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\WeatherController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ManagerController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



// Guest Routes 
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

 Route::middleware(['auth', 'customer'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stadiums/{id}', [DashboardController::class, 'show'])->name('stadiums.show');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/reservation-success', function() {
    return view('stadiums.show'); 
})->name('reservation');    
    Route::get('/mes-matchs', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});


//manager
Route::middleware(['auth', 'manager'])->group(function () {
    
    Route::get('/manager/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
    
    // Les offres
    Route::post('/stadiums/{stadium}/offers', [OfferController::class, 'storeAndAttachOffer'])->name('stadiums.offers.store');
    Route::delete('/stadiums/{stadium}/offers/{offer}', [OfferController::class, 'removeOfferFromStadium'])->name('stadiums.offers.remove');
    Route::patch('/manager/reservations/{id}/status', [ManagerController::class, 'updateReservationStatus'])
    ->name('manager.reservations.updateStatus');
    Route::get('/manager/mes-terrains', [ManagerController::class, 'afficherMesTerians'])->name('manager.stadiums');
    Route::get('/manager/reviews', [ManagerController::class, 'getManagerReviews'])->name('manager.reviews');
    Route::post('/manager/offers', [OfferController::class, 'storeAndAttachOffer'])->name('manager.offers.store');

    Route::get('/manager/offers', [ManagerController::class, 'getManagerOffers'])->name('manager.offers');

});




