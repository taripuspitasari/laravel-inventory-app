<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardPartnerController;
use App\Http\Controllers\DashboardTransactionController;
use App\Models\Transaction;

Route::get('/', function () {
    return view('index');
});

Route::get('/products', function () {
    return view('products', [
        'products' => Product::with('category')->filter(request(['search', 'category']))->latest()->get()
    ]);
});

Route::get('/categories/{category}', function (Category $category) {
    return view('category', [
        'category' => Category::with('products')->find($category->id)
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

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        "title" => "Home",
        "totalProducts" => Product::countProducts(),
        "totalStock" => Product::totalStock(),
        "totalTransactions" => Transaction::countTransactions()
    ]);
})->middleware('auth');

Route::resource('/dashboard/products', DashboardProductController::class)->middleware('auth');
Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('auth');
Route::resource('/dashboard/partners', DashboardPartnerController::class)->middleware('auth');
Route::resource('/dashboard/transactions', DashboardTransactionController::class)->middleware('auth');
