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

        $cart = Cart::with('cartDetails')->where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart is empty'], 200);
        }

        return response(new CartResource($cart), 201);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreCartRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            ['total_quantity' => 0, 'total_amount' => 0]
        );

        foreach ($data['cart_details'] as $cartDetail) {
            $product = Product::find($cartDetail['product_id']);
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            $cartItem = Cart_detail::where('cart_id', $cart->id)->where('product_id', $cartDetail['product_id'])->first();

            if ($cartItem) {
                $cartItem->quantity += $cartDetail['quantity'];
                $cartItem->price = $product->price;
                $cartItem->subtotal = $cartItem->quantity * $cartItem->price;
                $cartItem->save();
            } else {
                Cart_detail::create([
                    'cart_id' => $cart->id,
                    'product_id' => $cartDetail['product_id'],
                    'quantity' => $cartDetail['quantity'],
                    'price' => $product->price,
                    'subtotal' =>  $cartDetail['quantity'] * $product->price
                ]);
            }
        }

        $cart->total_quantity = $cart->cartDetails->sum('quantity');
        $cart->total_amount = $cart->cartDetails->sum('subtotal');
        $cart->save();

        return response(new CartResource($cart), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();

        $cart = Cart::with('cartDetails')->where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        return new CartResource($cart);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, $id)
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
    public function destroy($cartId)
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->find($cartId);

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        // hapus semua cart items
        $cart->details()->delete();

        $cart->total_quantity = 0;
        $cart->total_amount = 0;
        $cart->save();

        return response()->json(['message' => 'All items removed from cart successfully']);
    }

    public function destroyItem($cartId, $productId)
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->find($cartId);

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $cartItem = Cart_detail::where('cart_id', $cartId)->where('product_id', $productId)->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        $cartItem->delete();

        $cart->total_quantity = $cart->details->sum('quantity');
        $cart->total_amount = $cart->details->sum('subtotal');
        $cart->save();

        return response()->json(['message' => 'Item removed from cart successfully'], 200);
    }
}
