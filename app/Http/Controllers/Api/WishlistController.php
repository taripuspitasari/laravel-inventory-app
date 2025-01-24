<?php

namespace App\Http\Controllers\Api;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $wishlistItems = $user->wishlists;

        return WishlistResource::collection($wishlistItems);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id']
        ]);

        Wishlist::create([
            'product_id' => $data['product_id'],
            'user_id' => $user->id
        ]);

        $wishlistItems = $user->wishlists;

        return WishlistResource::collection($wishlistItems);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $wishlistItem = Wishlist::where('id', $id)->where('user_id', $user->id)
            ->first();

        $wishlistItem->delete();

        $wishlistItems = $user->wishlists;

        return WishlistResource::collection($wishlistItems);
    }
}
