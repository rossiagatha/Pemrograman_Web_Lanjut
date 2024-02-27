<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductsPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomePageController::class, 'hello']);

Route::get('/products', [ProductsPageController::class, 'products']);

Route::get('/category/food-beverage', [ProductsPageController::class, 'food_beverage']);

Route::get('/category/beauty-health', [ProductsPageController::class, 'beauty_health']);

Route::get('/category/home-care', [ProductsPageController::class, 'home_care']);

Route::get('/category/baby-kid', [ProductsPageController::class, 'baby_kid']);