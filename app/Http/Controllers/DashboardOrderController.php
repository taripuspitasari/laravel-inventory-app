<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardOrderController extends Controller
{
    public function index()
    {
        return view('dashboard.orders.index', [
            "title" => "Orders",
            "orders" => Order::with('user')->filter(request(['search', 'filter']))->latest()->simplePaginate(7)
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

        return view('dashboard.orders.edit', [
            "title" => "Edit Order",
            "order" => $order,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'order_status' => ['required']
        ]);

        if ($order->order_status === 'canceled') {
            return back()->with('error', 'Order already canceled');
        }

        $order->update($validatedData);

        return redirect('dashboard/orders')->with('success', 'The order has been updated!');
    }

    public function cancel(Order $order)
    {
        if ($order->order_status === 'canceled') {
            return back()->with('error', 'Order cannot be canceled');
        }

        if ($order->order_status !== 'pending') {
            return back()->with('error', 'Order cannot be canceled');
        }

        try {
            DB::beginTransaction();
            foreach ($order->orderDetails as $item) {
                $item->product->increment('stock', $item->quantity);

                StockMovement::create([
                    'product_id' => $item->product_id,
                    'type' => 'in',
                    'quantity' => $item->quantity,
                    'reference_type' => 'Order',
                    'reference_id' => $order->id,
                ]);
            }

            $order->update([
                'order_status' => 'canceled'
            ]);

            DB::commit();
            return redirect('dashboard/orders')->with('success', 'The order has been canceled and stock returned!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'The order cannot be canceled');
        }
    }
}
