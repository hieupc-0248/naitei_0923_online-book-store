<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
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


Route::get('/', [CategoryController::class, 'getAllCategoryAndBook'])
    ->name('homepage');

Route::get('/dashboard', [CategoryController::class, 'getAllCategoryAndBook'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/search', [BookController::class, 'search']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::resource('carts', CartController::class);
    Route::resource('reviews', ReviewController::class);
    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
});


require __DIR__ . '/auth.php';
