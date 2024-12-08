@extends('dashboard.layouts.sidebar')
@section('container')
<section class="flex flex-col md:flex-row gap-4">
    <div class="xl:w-1/2">
        <section class="p-4 bg-white flex justify-evenly items-center rounded-lg mb-4 shadow">
            <div>
                <h3 class="text-xl md:text-3xl">Hi, {{ auth()->user()->username }}</h3>
                <p class="text-sm text-slate-400">Have a nice day!</p>
                {{-- <ul class="text-sm">
                    <li>
                        <a class="flex gap-2 items-center m-1 font-semibold hover:underline" href="/dashboard/partners"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3">
                            <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>Manage Partner</a>
                    </li>
                    <li>
                        <a class="flex gap-2 items-center m-1 font-semibold hover:underline" href="/dashboard/categories"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3">
                            <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>Manage Category</a>
                    </li>
                </ul> --}}
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
        </section>
        
    </div>
</section>
@endsection