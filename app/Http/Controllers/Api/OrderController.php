<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
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
        $user = $request->user();
        $orders = $user->orders->latest()->get();
        return OrderResource::collection($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        try {
            DB::beginTransaction();

            $cartItems = Cart::where('user_id', $user->id)->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Cart is empty'], 404);
            }

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

            foreach ($cartItems as $item) {
                $product = Product::find($item->product_id);

                if ($product->stock < $item->quantity) {
                    return response()->json(['error' => "Product {$product->name} is out of stock"], 400);
                }

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $product->price,
                    'subtotal' => $item->quantity * $product->price,
                ]);

                $product->decrement('stock', $item->quantity);
            }

            Cart::where('user_id', $user->id)->delete();

            DB::commit();
            return new OrderResource($order);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $order = Order::with(['orderDetails.product', 'address'])->findOrFail($id);
        return new OrderResource($order);
    }
}
