<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Middleware\AuthenticateMiddleware;
use UniSharp\LaravelFileManager\Lfm;

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});


// ROUTES PHÍA BACKEND
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Trang tổng quan (chỉ admin mới truy cập được)
    Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');

    // Quản lý người dùng
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('index', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('show/{id}', [UserController::class, 'show'])->name('show');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Quản lý danh mục
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('index', [CategoriesController::class, 'index'])->name('index');
        Route::get('create', [CategoriesController::class, 'create'])->name('create');
        Route::post('store', [CategoriesController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CategoriesController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CategoriesController::class, 'update'])->name('update');
        Route::get('show/{id}', [CategoriesController::class, 'show'])->name('show');
        Route::delete('destroy/{id}', [CategoriesController::class, 'destroy'])->name('destroy');
    });

    // Quản lý sản phẩm
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('index', [ProductsController::class, 'index'])->name('index');
        Route::get('create', [ProductsController::class, 'create'])->name('create');
        Route::post('store', [ProductsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ProductsController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ProductsController::class, 'update'])->name('update');
        Route::get('show/{id}', [ProductsController::class, 'show'])->name('show');
        Route::delete('destroy/{id}', [ProductsController::class, 'destroy'])->name('destroy');
    });
});

// ROUTES PHÍA AUTH
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('admin', [AuthController::class, 'index'])->name('admin');
    Route::get('verify-account/{email}', [AuthController::class, 'verify'])->name('verify');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])
        ->name('register')
        ->middleware('guest');
    Route::post('register', [AuthController::class, 'check_register'])->name('register.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// ROUTES PHÍA FRONTEND
Route::get('/user', [HomeController::class, 'index'])->name('home.index');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

// Cart
Route::group(['prefix ' => 'cart'], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add/{product}', [CartController::class, 'addtoCart'])->name('add.cart');
    Route::get('/delete/{product}', [CartController::class, 'deleteCart'])->name('delete.cart');
    Route::get('update/{id}/{quantity}', [CartController::class, 'updateCart'])->name('update.cart');
});

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
