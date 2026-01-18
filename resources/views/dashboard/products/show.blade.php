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
        <h3 class="font-semibold text-md">Stock Movements</h3>
        <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100">
            <table class="table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Reference</th>
                </tr>
                </thead>
                <tbody>
                @forelse($stockMovements as $movement)
                <tr>
                    <td>{{  $movement->created_at->format('Y-m-d') }}</td>
                    <td class="uppercase">{{ $movement->type }}</td>
                    <td>{{ $movement->quantity }}</td>
                    <td>{{ $movement->reference_type }}</td>
                </tr>
                @empty
                <tr>
                    <td>No movement history yet</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $stockMovements->links() }}
    </div>

</section>
@endsection
