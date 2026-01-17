<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->latest()
            ->get();
        return OrderResource::collection($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['errors' => 'Cart is empty'], 404);
        }

        foreach ($cartItems as $item) {
            if (!$item->product) {
                return response()->json(['errors' => "Product not found"], 400);
            }

            if ($item->product->stock < $item->quantity) {
                return response()->json(['errors' => "Product {$item->product->name} is out of stock"], 400);
            }
        }

        try {
            DB::beginTransaction();

            $totalAmount = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $data['address_id'],
                'payment_method' => $data['payment_method'],
                'total_amount' => $totalAmount,
                'order_status' => $data['payment_method'] === 'cash' ? 'processed' : 'pending'
            ]);

            $date = $order->created_at->format('Ymd');
            $order->order_number = 'ORD-' . $date . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
            $order->save();

            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->quantity * $item->product->price,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            Cart::where('user_id', $user->id)->delete();

            DB::commit();
            return new OrderResource($order);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => 'Failed to create order'], 500);
        }
    }

    public function show(Order $order)
    {
        $order->load(['address', 'orderDetails']);

        return new OrderResource($order);
    }
}
