<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\WeatherController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



// Guest Routes 
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

 Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stadiums/{id}', [DashboardController::class, 'show'])->name('stadiums.show');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/reservation-success', function() {
    return view('stadiums.show'); 
})->name('reservation');
    Route::get('/mes-matchs', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/weather', [WeatherController::class, 'getWeather']);
Route::get('/check-match', [WeatherController::class, 'getMatchAdvice'])->name('weather.advice');


