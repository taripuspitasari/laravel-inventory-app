<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            "title" => "Home",
            "totalProducts" => Product::count(),
            "totalStock" => Product::sum('stock'),
            "totalTransactions" => Transaction::count(),
        ]);
    }
}
