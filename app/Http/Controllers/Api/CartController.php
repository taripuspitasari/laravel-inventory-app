<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartCollection;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->with('product')->get();

        if (!$carts) {
            return response()->json(['message' => 'Cart is empty'], 200);
        }

        return new CartCollection($carts);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreCartRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        $cart = Cart::firstOrCreate(
            ['product_id' => $data['product_id'], 'user_id' => $user->id],
            ['quantity' => 0]
        );

        $cart->quantity += $data['quantity'];
        $cart->save();

        $carts = Cart::where('user_id', $user->id)->with('product')->get();

        return response(new CartCollection($carts), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, $id)
    {
        $data = $request->validated();
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)
            ->where('id', $id)
            ->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $cart->quantity = $data['quantity'];
        $cart->save();

        $carts = Cart::where('user_id', $user->id)->with('product')->get();

        return response(new CartCollection($carts), 201);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId)
    {
        Cart::where('user_id', $userId)->delete();

        $carts = Cart::where('user_id', $userId)->get();

        return response(new CartCollection($carts), 201);
    }

    public function destroyItem($userId, $cartId)
    {
        $cart = Cart::where('user_id', $userId)->where('id', $cartId)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $cart->delete();

        $carts = Cart::where('user_id', $userId)->with('product')->get();

        return response(new CartCollection($carts), 201);
    }
}
