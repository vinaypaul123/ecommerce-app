<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});




Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::middleware('is_admin')->group(function () {
        Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::post('/cart/add/{product}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
    Route::delete('/cart/remove/{id}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.remove');
});


Route::middleware(['auth'])->group(function () {
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});

// Admin-only routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/usersview', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/products/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
});

require __DIR__.'/auth.php';
