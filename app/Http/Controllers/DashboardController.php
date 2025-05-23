<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with(['orderDetails', 'address'])->get();
        return view('dashboard.index', [
            "title" => "Home",
            "totalProducts" => Product::count(),
            "totalStock" => Product::sum('stock'),
            "totalTransactions" => Transaction::count(),
            "totalOrders" => Order::count(),
            "orders" => $orders
        ]);
    }
}
