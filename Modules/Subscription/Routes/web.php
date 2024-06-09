<?php
Route::middleware('admin')->group(function () {
    Route::prefix('subscription')->group(function () {
        Route::get('/plan', 'PlanController@index');
        Route::get('/plan/add', [
            Modules\Subscription\Http\Controllers\PlanController::class,
            'add'
        ]);
        Route::post('/plan/store', [
            Modules\Subscription\Http\Controllers\PlanController::class,
            'store'
        ]);
        Route::get('/plan/delete/{id}', [
            Modules\Subscription\Http\Controllers\PlanController::class,
            'destroy'
        ]);
        Route::get('/plan/edit/{id}', [
            Modules\Subscription\Http\Controllers\PlanController::class,
            'edit'
        ]);
        Route::post('/plan/update/{id}', [
            Modules\Subscription\Http\Controllers\PlanController::class,
            'update'
        ]);
        Route::get('/plan/show/{id}', [
            Modules\Subscription\Http\Controllers\PlanController::class,
            'show'
        ]);
        Route::get('/billing', 'BillingController@index');
        Route::get('/billing/delete/{id}', [
            Modules\Subscription\Http\Controllers\BillingController::class,
            'destroy'
        ]);
    });
});
