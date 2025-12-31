@extends('dashboard.layouts.sidebar')
@section('container')
<section class="w-full h-full space-y-2">
    <div class="flex flex-col md:flex-row gap-2">
        <div class="bg-white p-2 shadow-sm rounded-md md:h-44">
            <img class="mx-auto h-full" src="{{ asset('storage/' . $product->image) }}" alt="" />
        </div>
        <div class="bg-white p-2 shadow-sm rounded-md w-full flex flex-col justify-between">
            <div>
                <h3 class="font-semibold text-md">{{ $product->name }}</h3>
                <p class="text-gray-500">{{ $category }}</p>
                <p>{{ $product->description }}</p>
            </div>
            <div class="flex justify-between mt-3 gap-5">
                <p class="flex flex-col"><span class="text-gray-500">Stock</span><span>{{ $product->stock }}</span></p>
                <p class="flex flex-col"><span class="text-gray-500">Price</span><span>Rp {{ number_format($product->price, 0, ',', '.') }}</span></p>
            </div>
        </div>
    </div>

    <div class="space-y-2">
        <h3 class="font-semibold text-md">Recent Purchases</h3>
        <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100">
            <table class="table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Invoice</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                @forelse($purchases as $purchase)
                <tr>
                    <td>{{  $purchase->created_at->format('Y-m-d') }}</td>
                    <td><a href="/dashboard/purchases/{{ $purchase->id }}">{{ $purchase->invoice_number }}</a></td>
                    <td>{{ $purchase->pivot->quantity }}</td>
                </tr>
                @empty
                <tr>
                    <td>No purchases found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $purchases->links() }}
    </div>


    <div class="space-y-2">
        <h3 class="font-semibold text-md">Recent Orders</h3>
        <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100">
            <table class="table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Order ID</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{  $order->created_at->format('Y-m-d') }}</td>
                    <td><a href="/dashboard/orders/{{ $order->id }}">{{ $order->id }}</a></td>
                    <td>{{ $order->pivot->quantity }}</td>
                </tr>
                @empty
                <tr>
                    <td>No orders found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $orders->links() }}
    </div>
</section>
@endsection
