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
                    <div class="stat-title">All Orders</div>
                    <div class="stat-value">3</div>
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
        <section class="h-[calc(100vh-8rem)]  overflow-y-auto space-y-5 bg-white rounded-lg py-4 shadow">
            <div><h3 class="font-bold text-center px-2">Orders</h3></div>
            <div x-data="{ isOpen: false }" class="p-2 m-2 shadow-lg rounded-md bg-slate-200 dark:bg-gray-800 relative sm:rounded-lg overflow-x-hidden my-4">
                <div class="flex py-1 items-center justify-between text-xs font-medium">
                    <div>
                        <h5 class="text-gray-500">ORDER PLACED</h5>
                        <p>Oct 27, 2024</p>
                    </div>
                    <div>
                        <h5 class="text-gray-500">TOTAL</h5>
                        <p>Rp. 500.000</p>
                    </div>
                    <div>
                        <h5 class="text-gray-500">SHIP TO</h5>
                        <p>Jl. Cikeleng Pesantren No. 2</p>
                    </div>
                    <div>
                        <h5 class="text-gray-500">ORDER #112322123123</h5>
                        <button @click="isOpen = !isOpen" class="cursor-pointer hover:underline">Order Details</button>
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
                        <tr class="text-xs border-b text-left dark:border-gray-700 bg-white">
                            <td class="px-4 py-3">1</td>  
                            <td class="px-4 py-3">Stilleto</td>  
                            <td class="pr-10 py-3 text-right">4</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div x-data="{ isOpen: false }" class="p-2 m-2 shadow-lg rounded-md bg-slate-200 dark:bg-gray-800 relative sm:rounded-lg overflow-x-hidden my-4">
                <div class="flex py-1 items-center justify-between text-xs font-medium">
                    <div>
                        <h5 class="text-gray-500">ORDER PLACED</h5>
                        <p>Dec 11, 2024</p>
                    </div>
                    <div>
                        <h5 class="text-gray-500">TOTAL</h5>
                        <p>Rp. 1500.000</p>
                    </div>
                    <div>
                        <h5 class="text-gray-500">SHIP TO</h5>
                        <p>Pondok Pinang, Jakarta Selatan</p>
                    </div>
                    <div>
                        <h5 class="text-gray-500">ORDER #112322123123</h5>
                        <button @click="isOpen = !isOpen" class="cursor-pointer hover:underline">Order Details</button>
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
                        <tr class="text-xs border-b text-left dark:border-gray-700 bg-white">
                            <td class="px-4 py-3">1</td>  
                            <td class="px-4 py-3">Sneakers</td>  
                            <td class="pr-10 py-3 text-right">3</td>
                        </tr>
                        <tr class="text-xs border-b text-left dark:border-gray-700 bg-white">
                            <td class="px-4 py-3">2</td>  
                            <td class="px-4 py-3">Flat shoes</td>  
                            <td class="pr-10 py-3 text-right">2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div x-data="{ isOpen: false }" class="p-2 m-2 shadow-lg rounded-md bg-slate-200 dark:bg-gray-800 relative sm:rounded-lg overflow-x-hidden my-4">
                <div class="flex py-1 items-center justify-between text-xs font-medium">
                    <div>
                        <h5 class="text-gray-500">ORDER PLACED</h5>
                        <p>Dec 27, 2024</p>
                    </div>
                    <div>
                        <h5 class="text-gray-500">TOTAL</h5>
                        <p>Rp. 2.500.000</p>
                    </div>
                    <div>
                        <h5 class="text-gray-500">SHIP TO</h5>
                        <p>Jl. Cut Meutia No 42, Bekasi</p>
                    </div>
                    <div>
                        <h5 class="text-gray-500">ORDER #112322123123</h5>
                        <button @click="isOpen = !isOpen" class="cursor-pointer hover:underline">Order Details</button>
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
                        <tr class="text-xs border-b text-left dark:border-gray-700 bg-white">
                            <td class="px-4 py-3">1</td>  
                            <td class="px-4 py-3">Sneakers</td>  
                            <td class="pr-10 py-3 text-right">3</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</section>
@endsection