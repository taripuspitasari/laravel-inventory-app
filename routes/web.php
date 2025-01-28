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
        'products' => Product::with('category')->filter(request(['search', 'category']))->latest()->get()
    ]);
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('/dashboard/products', DashboardProductController::class)->middleware('auth');
Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('auth');
Route::resource('/dashboard/partners', DashboardPartnerController::class)->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index']);
    Route::get('/dashboard/transactions/create', [DashboardTransactionController::class, 'create']);
    Route::get('/dashboard/transactions/{transaction}', [DashboardTransactionController::class, 'show']);
    Route::post('/dashboard/transactions', [DashboardTransactionController::class, 'store']);
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/orders', [DashboardOrderController::class, 'index']);
    Route::get('/dashboard/orders/{order}', [DashboardOrderController::class, 'show']);
    Route::get('/dashboard/orders/{order}/edit', [DashboardOrderController::class, 'edit']);
    Route::put('/dashboard/orders/{order}', [DashboardOrderController::class, 'update']);
});
