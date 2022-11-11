<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ProductController::class, 'shopIndex'])->name('home');

Route::get('pet-shop/food', [ProductController::class,'shopList'])->name('pet-shop/food');



Route::get('pet-shop/contact', [ProductController::class, 'contact'])->name('pet-shop/contact');

Route::get('pet-shop/about', [PetController::class, 'about'])->name('pet-shop/about');

Route::get('pet-shop/product-details', [ProductController::class,'productDetails'])->name('pet-shop/product-details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('pet-shop/add', [ProductController::class,'addCart'])->name('pet-shop/add');

Route::get('pet-shop/checkout', [ProductController::class,'checkout'])->name('pet-shop/checkout');

Route::get('pet-shop/profile', [ProductController::class, 'profile'])->name('pet-shop/profile')->middleware('auth');

require __DIR__ . '/auth.php';

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
