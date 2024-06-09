<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\LoggerController;
use App\Http\Controllers\SmsController;

use App\Http\Controllers\Components\CommentComponentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverTagController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamTagController;
use App\Http\Controllers\TransportTypeController;
use App\Http\Controllers\VehicleTypeController;
use Modules\Catalog\Http\Controllers\CatalogController;
use Modules\Vendor\Http\Controllers\VendorController;
use Modules\Order\Http\Controllers\OrderController;

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapXmlController::class, 'index']);

//Components
Route::post('/dashboard/comment', [CommentComponentController::class, 'store']);

//stripe
// Route::get('stripe', [StripeController::class, 'stripe']);
// Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

//Landing Page
Route::get('/', [HomeController::class, 'welcome']);
Route::get('/home', [HomeController::class, 'home']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/privacy', [HomeController::class, 'privacy']);
Route::get('/terms', [HomeController::class, 'terms']);

//Auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/sign-in', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index']);
Route::post('register', [RegisterController::class, 'signup']);
Route::get('/user/confirm-email/{id}', [UserController::class, 'confirmEmail'])->name('user/confirm-email');
Route::get('/user/reset-email', [UserController::class, 'resetEmail']);
Route::post('/user/recover', [UserController::class, 'recover']);

Route::middleware('auth')->group(function () {

    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::prefix('dashboard')->group(function () {
        //Dashboard Route Section
        Route::get('/', [DashboardController::class, 'dashboard']);
        Route::get('/myprofile', [UserProfileController::class, 'show']);
        Route::get('/myprofile/edit/{id}', [UserProfileController::class, 'edit']);
        Route::put('/myprofile/update/{id}', [UserProfileController::class, 'update']);
        //Users

        Route::get('/orders', [OrderController::class, 'orders']);
    });


    Route::middleware('admin')->group(function () {

        Route::prefix('dashboard')->group(function () {

            Route::get('/team', [TeamController::class, 'index']);
            Route::get('/team/add', [TeamController::class, 'add']);
            Route::post('/team/save', [TeamController::class, 'create']);
            Route::delete('/team/delete/{id}', [TeamController::class, 'delete'])->name('team.delete');
            Route::get('/team/show/{id}', [TeamController::class, 'show']);
            Route::get('/team/edit/{id}', [TeamController::class, 'edit']);
            Route::put('/team/update/{id}', [TeamController::class, 'update']);

            Route::get('/users', [UserActivityController::class, 'users']);
            Route::get('/users/add', [UserController::class, 'add']);
            Route::post('/users/save', [UserController::class, 'addUser']);
            Route::get('/users/delete/{id}', [UserController::class, 'delete']);
            Route::get('/users/edit/{id}', [UserController::class, 'edit']);
            Route::put('/users/update/{id}', [UserController::class, 'update']);
            Route::get('/users/show/{id}', [UserController::class, 'show']);

            Route::get('/vendors', [VendorController::class, 'vendors']);
            Route::get('/vendors/add', [VendorController::class, 'add']);
            Route::post('/vendors/save', [VendorController::class, 'addVendor']);
            Route::get('/vendors/delete/{id}', [VendorController::class, 'delete']);
            Route::get('/vendors/edit/{id}', [VendorController::class, 'edit']);
            Route::put('/vendors/update/{id}', [VendorController::class, 'update']);
            Route::get('/vendors/show/{id}', [VendorController::class, 'show']);
            Route::get('/file-import', [VendorController::class, 'importView'])->name('import-view');
            Route::post('/import', [VendorController::class, 'import'])->name('import');

            Route::get('/promo-code', [PromoCodeController::class, 'index']);
            Route::get('/promo-code/add', [PromoCodeController::class, 'add']);
            Route::post('/promo-code/save', [PromoCodeController::class, 'create']);
            Route::get('/promo-code/show/{id}', [PromoCodeController::class, 'show']);
            Route::delete('/promo-code/delete/{id}', [PromoCodeController::class, 'delete'])->name('promo.delete');
            Route::get('/promo-code/edit/{id}', [PromoCodeController::class, 'edit']);
            Route::put('/promo-code/update/{id}', [PromoCodeController::class, 'update']);

            Route::get('/promotion', [PromotionController::class, 'index']);
            Route::get('/promotion/add', [PromotionController::class, 'add']);
            Route::post('/promotion/save', [PromotionController::class, 'create']);
            Route::get('/promotion/show/{id}', [PromotionController::class, 'show']);
            Route::delete('/promotion/delete/{id}', [PromotionController::class, 'delete'])->name('promotion.delete');
            Route::get('/promotion/edit/{id}', [PromotionController::class, 'edit']);
            Route::put('/promotion/update/{id}', [PromotionController::class, 'update']);

            Route::get('/team-tag', [TeamTagController::class, 'index']);
            Route::get('/team-tag/add', [TeamTagController::class, 'add']);
            Route::post('/team-tag/save', [TeamTagController::class, 'create']);
            Route::delete('/team-tag/delete/{id}', [TeamTagController::class, 'delete'])->name('tag.delete');
            Route::get('/team-tag/show/{id}', [TeamTagController::class, 'show']);
            Route::get('/team-tag/edit/{id}', [TeamTagController::class, 'edit']);
            Route::put('/team-tag/update/{id}', [TeamTagController::class, 'update']);

            Route::get('/driver-tag', [DriverTagController::class, 'index']);
            Route::get('/driver-tag/add', [DriverTagController::class, 'add']);
            Route::post('/driver-tag/save', [DriverTagController::class, 'create']);
            Route::delete('/driver-tag/delete/{id}', [DriverTagController::class, 'delete'])->name('driver-tag.delete');
            Route::get('/driver-tag/show/{id}', [DriverTagController::class, 'show']);
            Route::get('/driver-tag/edit/{id}', [DriverTagController::class, 'edit']);
            Route::put('/driver-tag/update/{id}', [DriverTagController::class, 'update']);

            Route::get('/transport-type', [TransportTypeController::class, 'index']);
            Route::get('/transport-type/add', [TransportTypeController::class, 'add']);
            Route::post('/transport-type/save', [TransportTypeController::class, 'create']);
            Route::delete('/transport-type/delete/{id}', [TransportTypeController::class, 'delete'])->name('transport.delete');
            Route::get('/transport-type/show/{id}', [TransportTypeController::class, 'show']);
            Route::get('/transport-type/edit/{id}', [TransportTypeController::class, 'edit']);
            Route::put('/transport-type/update/{id}', [TransportTypeController::class, 'update']);

            Route::get('/vehicle-type', [VehicleTypeController::class, 'index']);
            Route::get('/vehicle-type/add', [VehicleTypeController::class, 'add']);
            Route::post('/vehicle-type/save', [VehicleTypeController::class, 'create']);
            Route::get('/vehicle-type/show/{id}', [VehicleTypeController::class, 'show']);
        });

        Route::get('services', [DashboardController::class, 'displaylogs']);
        //Files
        Route::get('files', [DashboardController::class, 'Showfiles']);

        //Backup
        Route::get('dashboard/backup', [BackupController::class, 'show']);
        Route::get('backup/create', [BackupController::class, 'backup']);
        Route::get('backup/download/{filename}', [BackupController::class, 'download']);
        Route::get('backup/delete/{filename}', [BackupController::class, 'Delete']);
        Route::get('backup/restore/{filename}', [BackupController::class, 'restore']);

        //User Activity
        Route::get('logActivity', [UserActivityController::class, 'logActivity']);
        Route::get('delete/{id}', [UserActivityController::class, 'delete']);

        //log profiler
        Route::get('logs', [LoggerController::class, 'index']);

        //upload pictures
        Route::get('open', [ImageUploadController::class, 'showUploadPage']);
        Route::post('upload', [ImageUploadController::class, 'fileUpload']);


        //Error logs
        Route::get('dashboard/logs', [LoggerController::class, 'logs']);
        Route::get('dashboad/logs/delete/{id}', [LoggerController::class, 'destroy']);

        Route::get('sms/', [SmsController::class, 'index']);
        Route::get('sms/add', [SmsController::class, 'add']);
        Route::post('sms/send', [SmsController::class, 'send']);

        /**
         * Banners Section
         */
        Route::controller(BannerController::class)->prefix('/banners')->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/store', 'store');
            Route::get('/edit/{bannerId}', 'edit');
            Route::get('/view/{bannerId}', 'view');
            Route::get('/delete/{bannerId}', 'destroy');
        });
    });
    Route::middleware('vendor')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/driver', [DriverController::class, 'index']);
            Route::get('/driver/add', [DriverController::class, 'add']);
            Route::post('/driver/save', [DriverController::class, 'create']);
            Route::delete('/driver/delete/{id}', [DriverController::class, 'delete'])->name('driver.delete');
            Route::get('/driver/show/{id}', [DriverController::class, 'show']);

            Route::get('/customer', [CustomerController::class, 'index']);
            Route::get('/customer/add', [CustomerController::class, 'add']);
            Route::post('/customer/save', [CustomerController::class, 'create']);
            Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
            Route::get('/customer/show/{id}', [CustomerController::class, 'show']);
        });
    });
});
