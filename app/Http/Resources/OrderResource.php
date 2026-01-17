<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'payment_method' => $this->payment_method,
            'order_status' => $this->order_status,
            'total_amount' => $this->total_amount,
            'created_at' => $this->created_at->format('M d, Y'),
            'address' => new AddressResource($this->whenLoaded('address')),
            'order_details' => OrderDetailResource::collection(
                $this->whenLoaded('orderDetails')
            ),
        ];
    }
}
