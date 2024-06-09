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

use Modules\Catalog\Http\Controllers\CatalogController;

Route::prefix('catalog')->group(function() {
    Route::get('/', 'CatalogController@index');
    Route::get('/category', [CatalogController::class, 'catalogCategory']);
    Route::get('/category/add', [CatalogController::class, 'addCatalogCategory']);
    Route::post('/category/save', [CatalogController::class, 'createCatalogCategory']);
    Route::get('/category/show/{id}', [CatalogController::class, 'showCatalogCategory']);
    Route::get('/category/delete/{id}', [CatalogController::class, 'deleteCatalogCategory']);
    Route::get('/category/edit/{id}', [CatalogController::class, 'editCatalogCategory']);
    Route::put('/category/update/{id}', [CatalogController::class, 'updateCatalogCategory']);

    Route::get('/subcategory', [CatalogController::class, 'catalogSubCategory']);
    Route::get('/subcategory/add', [CatalogController::class, 'addCatalogSubCategory']);
    Route::post('/subcategory/save', [CatalogController::class, 'createCatalogSubCategory']);
    Route::get('/subcategory/show/{id}', [CatalogController::class, 'showCatalogSubCategory']);
    Route::get('/subcategory/delete/{id}', [CatalogController::class, 'deleteCatalogSubCategory']);
    Route::get('/subcategory/edit/{id}', [CatalogController::class, 'editCatalogSubCategory']);
    Route::put('/subcategory/update/{id}', [CatalogController::class, 'updateCatalogSubCategory']);
});
