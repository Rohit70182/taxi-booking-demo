<?php

use App\Http\Controllers\API\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('user')->group(function () {
    Route::post('/register', [
        \App\Http\Controllers\API\UserController::class,
        'register'
    ]);
    Route::post('/login', [
        \App\Http\Controllers\API\UserController::class,
        'login'
    ]);
    Route::post('/page-detail', [
        \App\Http\Controllers\API\UserController::class,
        'pageDetail'
    ]);
    Route::post('/update-driver-location', [
        \App\Http\Controllers\API\UserController::class,
        'updateDriverLocation'
    ]);
    Route::post('/rating-and-review', [
        \App\Http\Controllers\API\UserController::class,
        'ratingAndReview'
    ]);
    Route::get('/rating-list', [
        \App\Http\Controllers\API\UserController::class,
        'ratingList'
    ]);
    Route::get('/profile-detail', [
        \App\Http\Controllers\API\UserController::class,
        'profileDetail'
    ]);

    Route::get('/wallet-detail', [
        \App\Http\Controllers\API\UserController::class,
        'walletDetail'
    ]);

    Route::post('/wallet-top-up', [
        \App\Http\Controllers\API\UserController::class,
        'walletTopUp'
    ]);

    Route::post('/pay-ride', [
        \App\Http\Controllers\API\UserController::class,
        'payRide'
    ]);
    Route::get('/ride-status', [
        \App\Http\Controllers\API\UserController::class,
        'rideStatus'
    ]);
    Route::get('/logout', [
        \App\Http\Controllers\API\UserController::class,
        'logout'
    ]);
    Route::post('/change-password', [
        \App\Http\Controllers\API\UserController::class,
        'changePassword'
    ]);
    Route::get('/check', [
        \App\Http\Controllers\API\UserController::class,
        'userCheck'
    ]);
    Route::get('/nearest-driver', [
        \App\Http\Controllers\API\UserController::class,
        'nearestDriver'
    ]);
});

Route::prefix('booking')->group(function () {
    Route::post('/driver-booking-list', [
        \App\Http\Controllers\API\BookingController::class,
        'index'
    ]);

    Route::post('/booking-detail', [
        \App\Http\Controllers\API\BookingController::class,
        'show'
    ]);

    Route::post('/customer-booking-list', [
        \App\Http\Controllers\API\BookingController::class,
        'customerBookingList'
    ]);

    Route::post('/vehicle-detail', [
        \App\Http\Controllers\API\BookingController::class,
        'vehicleDetail'
    ]);

    Route::post('/ride-request', [
        \App\Http\Controllers\API\BookingController::class,
        'rideRequest'
    ]);

    Route::get('/fare-estimate', [
        \App\Http\Controllers\API\BookingController::class,
        'fareEstimate'
    ]);

    Route::get('/ride-request', [
        \App\Http\Controllers\API\BookingController::class,
        'rideRequest'
    ]);
});

Route::prefix('stripe')->group(function () {
    Route::get('/card-list', [
        \App\Http\Controllers\API\StripeController::class,
        'cardList'
    ]);
});