<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
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

Route::get('/search', [BookController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::resource('carts', CartController::class);
    Route::post('/store-reviews', [ReviewController::class, 'store'])->name('store.review');
    Route::resource('orders', OrderController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'all'])->name('orders.all');
    Route::get('/admin/orders/{order}', [OrderController::class, 'showDetail'])->name('orders.show_detail');
    Route::post('/admin/orders/update', [OrderController::class, 'updateStatus'])->name('orders.update_status');
});

Route::middleware('auth')->group(function () {
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::post('/increase-quantity', [CartController::class, 'increase']);
    Route::post('/decrease-quantity', [CartController::class, 'decrease']);
});

Route::get('/language/{lang}', [LanguageController::class, 'changeLanguage'])->name('locale');


require __DIR__ . '/auth.php';
