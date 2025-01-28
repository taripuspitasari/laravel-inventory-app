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
            "orders" => Order::with('user')->filter(request(['search', 'filter']))->simplePaginate(7)
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

    public function edit(Order $order)
    {
        $order->load(['address', 'orderDetails.product', 'user']);
        $total_items = $order->orderDetails->count();

        return view('dashboard.orders.edit', [
            "title" => "Edit Order",
            "order" => $order,
            "totalItems" => $total_items
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'payment_status' => ['required'],
            'order_status' => ['required']
        ]);

        $order->update($validatedData);

        return redirect('dashboard/orders')->with('success', 'The order has been updated!');
    }
}
