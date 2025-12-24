<?php

namespace App\Http\Controllers\Api;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class WishlistController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => $request->user()
                ->wishlists()
                ->pluck('product_id')
                ->values()
        ]);
    }

    public function toggle(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id']
        ]);

        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $data['product_id'])
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json([
                'data' => $data['product_id'],
                'message' => 'removed'
            ]);
        }

        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $data['product_id']
        ]);

        return response()->json([
            'data' => $data['product_id'],
            'message' => 'added'
        ]);
    }
}
