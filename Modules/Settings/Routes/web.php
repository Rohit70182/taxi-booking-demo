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

Route::prefix('settings')->group(function() {
    Route::get('/', 'SettingsController@index');
    Route::get('/add', [
        Modules\Settings\Http\Controllers\SettingsController::class,
        'create'
    ]);
    Route::post('/save', [
        Modules\Settings\Http\Controllers\SettingsController::class,
        'store'
    ]);
    Route::get('/edit/{id}', [
        Modules\Settings\Http\Controllers\SettingsController::class,
        'edit'
    ]);
     Route::get('/delete/{id}', [
        Modules\Settings\Http\Controllers\SettingsController::class,
        'destroy'
    ]);
     Route::get('/show/{id}', [
        Modules\Settings\Http\Controllers\SettingsController::class,
        'show'
    ]);
      Route::post('/update/{id}', [
        Modules\Settings\Http\Controllers\SettingsController::class,
        'update'
    ]);
});
