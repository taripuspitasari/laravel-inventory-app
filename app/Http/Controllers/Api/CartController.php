<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Cart_detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart is empty'], 200);
        }

        return new CartResource($cart);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        // get cart user
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            ['total_quantity' => 0, 'total_amount' => 0]
        );

        // get product to access
        $product = Product::find($data['product_id']);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }


        $cartItem = Cart_detail::where('cart_id', $cart->id)->where('product_id', $data['product_id'])->first();

        if ($cartItem) {
            $cartItem->quantity += $data['quantity'];
            $cartItem->price = $product->price;
            $cartItem->subtotal = $cartItem->quantity * $cartItem->price;
            $cartItem->save();
        } else {
            $cartItem = Cart_detail::create([
                'cart_id' => $cart->id,
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'price' => $product->price,
                'subtotal' => $data['quantity'] * $product->price,
            ]);
        }

        $cart->total_quantity = $cart->details->sum('quantity');
        $cart->total_amount = $cart->details->sum('subtotal');
        $cart->save();

        return response(new CartResource($cartItem), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        return new CartResource($cart);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, string $id)
    {
        $data = $request->validated();
        // $user = auth()->user();

        $cartItem = Cart_detail::where('cart_id', $id)->where('product_id', $data['product_id'])->first();
        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        $product = Product::find($data['product_id']);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $cartItem->quantity = $data['quantity'];
        $cartItem->price = $product->price;
        $cartItem->subtotal = $data['quantity'] * $product->price;
        $cartItem->save();

        $cart = Cart::find($id);
        $cart->total_quantity = $cart->details->sum('quantity');
        $cart->total_amount = $cart->details->sum('subtotal');
        $cart->save();

        return response(new CartResource($cart), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
