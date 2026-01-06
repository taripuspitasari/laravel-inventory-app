<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            "title" => "Home",
            "totalProducts" => Product::count(),
            "totalStock" => Product::sum('stock'),
            'totalOutOfStock' => Product::where('stock', 0)->count(),
            "totalOrders" => Order::count(),
            "topProducts" => Product::withSum('orderDetails as total_qty_sold', 'quantity')->orderByDesc('total_qty_sold')->limit(8)->get(),
            "totalSold" => OrderDetail::sum('quantity')
        ]);
    }
}
