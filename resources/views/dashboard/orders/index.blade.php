@extends('dashboard.layouts.sidebar')
@section('container')
<section>
    <div class="flex flex-col md:flex-row gap-2">
        <div class="md:w-96">
            <form action="/dashboard/orders" method="get" class="flex items-center">
                <label for="search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="search" name="search" id="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search orders" autocomplete="off" value="{{ request('search') }}">
                </div>
            </form>
        </div>
        <div class="flex flex-col md:flex-row gap-2 relative" x-data="{open:false}">
            <button x-on:click="open = !open" id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                </svg>
                Filter
                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                </svg>
            </button>
            <div x-show="open" x-on:mouseenter="open = true" x-on:mouseleave="open = false" id="actionsDropdown" class="absolute top-10 right-18 z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" x-cloak>
                <form action="/dashboard/orders" method="get">
                    <input type="hidden" name="filter" id="filterValue">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                        <li>
                            <button type="submit" onclick="document.getElementById('filterValue').value='completed'" class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Completed</button>
                        </li>
                        <li>
                            <button type="submit" onclick="document.getElementById('filterValue').value='processed'" class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Processed</button>
                        </li>
                        <li>
                            <button type="submit" onclick="document.getElementById('filterValue').value='pending'" class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pending</button>
                        </li>
                        <li>
                            <button type="submit" onclick="document.getElementById('filterValue').value='shipped'" class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Shipped</button>
                        </li>
                        <li>
                            <button type="submit" onclick="document.getElementById('filterValue').value='canceled'" class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Canceled</button>
                        </li>
                        <li>
                            <button type="submit" onclick="document.getElementById('filterValue').value=''" class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">All</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>

    @if(session()->has('success'))
    <div x-data="{show:true}" x-init="setTimeout(()=> show = false, 5000)" x-show="show" role="alert" class="flex justify-center md:justify-start alert alert-success mt-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current text-white" fill="none" viewBox="0 0 24 24">
            <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-white">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white relative dark:bg-gray-800 shadow-md my-4">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">No.</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Order ID</th>
                        <th scope="col" class="px-4 py-3">Customer</th>
                        <th scope="col" class="px-4 py-3">Payment</th>
                        <th scope="col" class="px-4 py-3 text-center">Status</th>
                        <th scope="col" class="px-3 py-3 text-right">Total</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-3">{{ $loop->iteration + ($orders->currentPage()-1) * $orders->perPage() }}</td>
                            <th scope="row" class="px-4 py-3"><a href="/dashboard/orders/{{ $order->id }}">{{ $order->id }}</a></th>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $order->user->name }}</td>
                            <td class="px-4 py-3 uppercase">{{ $order->payment_method }}</td>
                            <td class="px-4 py-3"><p class="capitalize {{ $order->payment_status === "paid" ? 'bg-lime-100 text-lime-800' : 'bg-rose-100 text-rose-800' }} px-2 rounded-md text-center">{{ $order->payment_status }}</p></td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 flex items-center justify-center" x-data="{open:false}">
                                <button x-on:click="open = true" x-on:mouseleave="open = false" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div x-show="open" x-on:mouseenter="open = true" x-on:mouseleave="open = false" class="absolute z-50 right-0 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" x-cloak>
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                        <li>
                                            <a href="/dashboard/orders/{{ $order->id }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                        </li>
                                        <li>
                                            <a href="/dashboard/orders/{{ $order->id }}/edit" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="border-b dark:border-gray-700">
                            <td colspan="7" class="px-4 py-3 text-center">No orders found</td>
                        </tr>
                        @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $orders->links() }}
</section>
@endsection