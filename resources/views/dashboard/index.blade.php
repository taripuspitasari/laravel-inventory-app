@extends('dashboard.layouts.sidebar')
@section('container')
<section class="flex flex-col md:flex-row gap-4">
    <div class="xl:w-1/2">
        <section class="p-4 bg-white flex justify-evenly items-center rounded-lg mb-4 shadow">
            <div>
                <h3 class="text-xl md:text-3xl">Hi, {{ explode(' ',auth()->user()->name)[0] }}</h3>
                <p class="text-sm text-slate-400">Have a nice day!</p>
            </div>
            <div>
                <img src="{{ asset('images/blue-dashboard.png') }}" alt="" class="h-36 md:h-52">
            </div>
        </section>
        <section class="flex flex-col justify-evenly items-center shadow p-1 bg-white rounded-lg">
            <div class="stats flex flex-col md:flex-row w-full rounded-none">
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
            <div class="stats flex flex-col md:flex-row w-full rounded-none">
                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-primary-700 inline-block h-8 w-8 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                    </div>
                    <div class="stat-title">Total Stock</div>
                    <div class="stat-value">{{ $totalStock }}</div>
                </div>
                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="text-primary-700 inline-block h-8 w-8 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                            </path>
                        </svg>
                    </div>
                    <div class="stat-title">All Transactions</div>
                    <div class="stat-value">{{ $totalTransactions }}</div>
                </div>
            </div>
        </section>
    </div>
    <div class="xl:w-1/2">
        <section class="h-[calc(100vh-8rem)] bg-white rounded-lg mb-4 shadow">
            <h3 class="font-bold text-center p-2">Incoming Orders</h3>
            <div class="p-2 m-2 shadow-lg rounded-md bg-slate-200 dark:bg-gray-800 relative sm:rounded-lg overflow-x-hidden my-4">
                <div class="flex py-1 items-center justify-between">
                    <h4 class="font-bold">Order #3445</h4>
                    <a href="" class="flex items-center justify-center text-white bg-slate-500 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        Detail
                    </a>
                </div>
                <table class="rounded-md w-full">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">Product</th>
                            <th scope="col" class="px-4 py-3">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-gray-700 text-center bg-white">
                            <td class="px-4 py-3">1</td>  
                            <td class="px-4 py-3">Stilleto</td>  
                            <td class="px-4 py-3 text-right">4</td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            <div class="p-2 m-2 shadow-lg rounded-md bg-slate-200 dark:bg-gray-800 relative sm:rounded-lg overflow-x-hidden my-4">
                <div class="flex py-1 items-center justify-between">
                    <h4 class="font-bold">Order #3446</h4>
                    <a href="" class="flex items-center justify-center text-white bg-slate-500 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        Detail
                    </a>
                </div>
                <table class="rounded-md w-full">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">Product</th>
                            <th scope="col" class="px-4 py-3">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-gray-700 text-center bg-white">
                            <td class="px-4 py-3">1</td>  
                            <td class="px-4 py-3">Sneakers</td>  
                            <td class="px-4 py-3 text-right">10</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</section>
@endsection