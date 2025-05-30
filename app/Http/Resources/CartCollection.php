<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => CartResource::collection($this->collection),
            'total_quantity' => $this->collection->sum('quantity'),
            'total_amount' => $this->collection->sum(function ($cart) {
                return $cart->quantity * $cart->product->price;
            })
        ];
    }
}
