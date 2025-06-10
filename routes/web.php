<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\BookingController;
use App\Models\Collection;
use App\Models\Services;
use App\Models\Pricing;
use App\Models\Barber;

Route::get('/', function () {
    $collections = Collection::all();
    $services = Services::all();
    $pricing = Pricing::all();
    $barbers = Barber::all();
    return view('index', compact('collections', 'services', 'pricing', 'barbers'));
})->name('home');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('next', [CollectionController::class, 'index'])->name('next');
Route::view('/about', 'about')->name('about');

Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

