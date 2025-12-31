@extends('dashboard.layouts.sidebar')
@section('container')
<section class="flex flex-col lg:flex-row gap-4">
    <div class="lg:w-1/2 ">
        <div class="lg:h-[calc(100vh-8rem)] flex flex-col justify-between">
            <section class="p-4 bg-white flex justify-evenly items-center rounded-lg mb-4 shadow">
                <div>
                    <h3 class="text-xl lg:text-3xl">Hi, {{ explode(' ',auth()->user()->name)[0] }}</h3>
                    <p class="text-sm text-slate-400">Have a nice day!</p>
                </div>
                <div>
                    <img src="{{ asset('images/blue-dashboard.png') }}" alt="" class="h-36 lg:h-52">
                </div>
            </section>
            <section class="flex flex-col justify-evenly items-center shadow p-1 bg-white rounded-lg">
                <div class="stats flex flex-col lg:flex-row w-full rounded-none">
                    <div class="stat">
                        <div class="stat-figure text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block text-primary-700 h-8 w-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                </path>
                            </svg>
                        </div>
                        <div class="stat-title">All Products</div>
                        <div class="stat-value">{{ $totalProducts }}</div>
                    </div>
                    <div class="stat">
                        <div class="stat-figure text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-primary-700 inline-block h-8 w-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <div class="stat-title">Total Stock</div>
                        <div class="stat-value">{{ $totalStock }}</div>
                    </div>
                </div>
                <div class="stats flex flex-col lg:flex-row w-full rounded-none">
                    <div class="stat">
                        <div class="stat-figure text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-primary-700 inline-block h-8 w-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <div class="stat-title">All Orders</div>
                        <div class="stat-value">{{ $totalOrders }}</div>
                    </div>
                    <div class="stat">
                        <div class="stat-figure text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="text-primary-700 inline-block h-8 w-8 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                                </path>
                            </svg>
                        </div>
                        <div class="stat-title">All Purchases</div>
                        <div class="stat-value">{{ $totalPurchases }}</div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="lg:w-1/2">
        <section class="  h-[calc(100vh-8rem)] overflow-y-auto space-y-5 bg-white rounded-lg py-4 shadow">
            <div><h3 class="font-bold text-center px-2">Pending orders</h3></div>
            @forelse($orders as $order)
            <div x-data="{ isOpen: false }" class="p-2 m-2 shadow-lg rounded-md bg-slate-200 dark:bg-gray-800 relative sm:rounded-lg overflow-x-hidden my-4">
                <div class="flex md:flex-row flex-col py-1 md:items-center md:justify-between text-xs font-medium">
                    <div class="flex md:flex-col flex-row justify-between">
                        <h5 class="text-gray-500">ORDER PLACED</h5>
                        <p>{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="flex md:flex-col flex-row justify-between">
                        <h5 class="text-gray-500">TOTAL</h5>
                        <p>{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex md:flex-col flex-row justify-between">
                        <h5 class="text-gray-500">SHIP TO</h5>
                        <p>{{ $order->address->address }}</p>
                    </div>
                    <div class="flex md:flex-col flex-row justify-between">
                        <h5 class="text-gray-500">ORDER #{{ $order->id }}</h5>
                        <button @click="isOpen = !isOpen" class="p-1 bg-primary-600 rounded-md text-white cursor-pointer hover:bg-primary-700">Details</button>
                    </div>
                </div>
                <table x-bind:class="{'hidden': !isOpen, '': isOpen}" class="hidden w-full">
                    <thead class="text-left text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="text-xs">
                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">Product</th>
                            <th scope="col" class="pr-10 py-3 text-right">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $item)
                        <tr class="text-xs border-b text-left dark:border-gray-700 bg-white">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>  
                            <td class="px-4 py-3">{{ $item->product->name }}</td>  
                            <td class="pr-10 py-3 text-right">{{ $item->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @empty
            <div class="flex flex-col justify-center items-center">
                <img src="{{ asset('images/ice-fishing.png') }}" alt="" class="h-36 md:h-52 opacity-90 mt-10">
                <p class="text-gray-500 mt-4 font-semibold">Waiting for orders...</p>
            </div>
            @endforelse
        </section>
    </div>
</section>
@endsection