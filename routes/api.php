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
Route::any('/search-wise-product', [App\Http\Controllers\api\DashboardController::class, 'searchwiseproduct']);

//Address Controller
Route::any('/address-process', [App\Http\Controllers\api\AddressController::class, 'addressProcess']);
Route::any('/get-user-address', [App\Http\Controllers\api\AddressController::class, 'getuseraddress']);
Route::get('/state', [App\Http\Controllers\api\AddressController::class, 'state']);
Route::get('/countries', [App\Http\Controllers\api\AddressController::class, 'countries']);
Route::any('/city', [App\Http\Controllers\api\AddressController::class, 'city']);

//Login Controller
Route::any('/register-process', [App\Http\Controllers\api\LoginController::class, 'registerProcess']);
Route::any('/user-login', [App\Http\Controllers\api\LoginController::class, 'userLogin']);
