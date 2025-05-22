<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardOrderController;
use App\Http\Controllers\DashboardPartnerController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardTransactionController;

Route::get('/', function () {
    return view('index');
});

Route::get('/products', function () {
    return view('products', [
        'products' => Product::with('category')->filter(request(['search', 'category']))->latest()->simplePaginate(8)
    ]);
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login',  'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->middleware('guest');
    Route::post('/register', 'store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/dashboard/products', DashboardProductController::class);
    Route::resource('/dashboard/categories', DashboardCategoryController::class);
    Route::resource('/dashboard/partners', DashboardPartnerController::class);

    Route::controller(DashboardTransactionController::class)->group(function () {
        Route::get('/dashboard/transactions', 'index');
        Route::get('/dashboard/transactions/create', 'create');
        Route::get('/dashboard/transactions/{transaction}', 'show');
        Route::post('/dashboard/transactions', 'store');
    });

    Route::controller(DashboardOrderController::class)->group(function () {
        Route::get('/dashboard/orders', 'index');
        Route::get('/dashboard/orders/{order}', 'show');
        Route::get('/dashboard/orders/{order}/edit', 'edit');
        Route::put('/dashboard/orders/{order}', 'update');
    });
});
