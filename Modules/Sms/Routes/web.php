<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;
use Modules\Sms\Http\Controllers\GatewayController;
use Modules\Sms\Http\Controllers\HistoryController;


Route::middleware('auth')->prefix('sms')->group(function () {
        
    Route::prefix('gateway')->group(function () {
        Route::get('/', [GatewayController::class, 'index']);
        Route::get('/add', [GatewayController::class, 'add']);
        Route::get('/details', [GatewayController::class, 'details'])->name('gateway_details');
        Route::get('/store', [GatewayController::class, 'store']);
        Route::post('/account', [GatewayController::class, 'account']);
        
        Route::get('/show/{id}', [GatewayController::class, 'show']);
        Route::get('/edit/{id}', [GatewayController::class, 'edit']);
        Route::post('/update/{id}', [GatewayController::class, 'update']);
        Route::get('/view/{id}', [GatewayController::class, 'view']);
        Route::get('/delete/{id}', [GatewayController::class, 'destroy']);
        
        
        
       
       
        
    });
        
});
    Route::middleware('auth')->prefix('sms')->group(function () {
        
        Route::prefix('history')->group(function () {
            Route::get('/',[HistoryController::class,'index']);
        });
            
    });