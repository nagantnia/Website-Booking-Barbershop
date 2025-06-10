<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CollectionApiController;
use App\Http\Controllers\Api\ServicesApiController;
use App\Http\Controllers\Api\PricingApiController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\BarberApiController;
use App\Http\Controllers\Api\BookingApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public endpoints (read-only)
Route::get('collections', [CollectionApiController::class, 'index']);
Route::get('services', [ServicesApiController::class, 'index']);
Route::get('pricings', [PricingApiController::class, 'index']);
Route::get('posts', [PostApiController::class, 'index']);
Route::get('users', [UserApiController::class, 'index']);
Route::get('barbers', [BarberApiController::class, 'index']);
Route::get('bookings', [BookingApiController::class, 'index']);

// Admin endpoints (CRUD, protected)

    Route::apiResource('admin/collections', CollectionApiController::class);
    Route::apiResource('admin/services', ServicesApiController::class);
    Route::apiResource('admin/pricings', PricingApiController::class);
    Route::apiResource('admin/posts', PostApiController::class);
    Route::apiResource('admin/users', UserApiController::class);
    Route::apiResource('admin/barbers', BarberApiController::class);
    Route::apiResource('admin/bookings', BookingApiController::class);
