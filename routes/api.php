<?php

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

//DashboardController
    Route::get('/settingsData', [App\Http\Controllers\api\DashboardController::class, 'settingsData']);
    Route::post('/page', [App\Http\Controllers\api\DashboardController::class, 'page']);
    Route::get('/menu', [App\Http\Controllers\api\DashboardController::class, 'menu']);
    Route::get('/footer', [App\Http\Controllers\api\DashboardController::class, 'footer']);
    Route::post('/contact-process', [App\Http\Controllers\api\DashboardController::class, 'contactprocess']);
    Route::get('/slider-banner', [App\Http\Controllers\api\DashboardController::class, 'sliderbanner']);
    Route::get('/faq', [App\Http\Controllers\api\DashboardController::class, 'faq']);
    Route::get('/featuredourteam', [App\Http\Controllers\api\DashboardController::class, 'featuredourteam']);
    Route::any('/product', [App\Http\Controllers\api\DashboardController::class, 'product']);
    Route::post('/product-details', [App\Http\Controllers\api\DashboardController::class, 'productDetails']);
    Route::get('/category', [App\Http\Controllers\api\DashboardController::class, 'category']);
        Route::any('/category-wise-product', [App\Http\Controllers\api\DashboardController::class, 'categorywiseproduct']);
        Route::any('/newsletter', [App\Http\Controllers\api\DashboardController::class, 'newsletter']);

