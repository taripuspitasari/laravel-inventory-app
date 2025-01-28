<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardOrderController extends Controller
{
    public function index()
    {
        return view('dashboard.orders.index', [
            "title" => "Orders",
            "orders" => Order::with('user')->simplePaginate(7)
        ]);
    }

    public function show(Order $order)
    {
        $order->load(['address', 'orderDetails.product', 'user']);
        $total_items = $order->orderDetails->count();

        return view('dashboard.orders.show', [
            "title" => "Order Detail",
            "order" => $order,
            "totalItems" => $total_items
        ]);
    }

    public function edit() {}

    public function update() {}
}
