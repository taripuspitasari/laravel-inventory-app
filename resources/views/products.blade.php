@extends('layouts.main')
@section('container')
<div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    {{-- row --}}
    <div class="py-4 px-4 mx-auto max-w-screen-xl lg:px-6">
        <div class="mx-auto max-w-screen-md sm:text-center">
            <form action="/products" method="get">
                @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                    <div class="relative w-full">
                        <label for="search" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search</label>
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for product" type="search" id="search" name="search" autocomplete="off">
                    </div>
                    <div>
                        <button type="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
        {{-- card --}}
        @forelse ($products as $product)
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="h-56 w-full">
                <a href="#">
                    <img class="mx-auto h-full" src="{{ asset('storage/' . $product->image) }}"/>
                </a>
            </div>
            <div class="pt-6">
                <h2 class="text-lg font-semibold leading-tight text-gray-900 dark:text-white">{{ $product->name }}</h2>
                <ul class="mt-2 flex items-center gap-4">
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.583 8.445h.01M10.86 19.71l-6.573-6.63a.993.993 0 0 1 0-1.4l7.329-7.394A.98.98 0 0 1 12.31 4l5.734.007A1.968 1.968 0 0 1 20 5.983v5.5a.992.992 0 0 1-.316.727l-7.44 7.5a.974.974 0 0 1-1.384.001Z"/>
                        </svg>
                        <a href="/products?category={{ $product->category->id }}" class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ $product->category->name }}
                        </a>                        
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8H5m12 0a1 1 0 0 1 1 1v2.6M17 8l-4-4M5 8a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.6M5 8l4-4 4 4m6 4h-4a2 2 0 1 0 0 4h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1Z"/>
                        </svg>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </li>
                </ul>
                {{ $product->description }}
                <div class="mt-4 flex items-center justify-between gap-4">
                    <p class="text-lg font-extrabold leading-tight text-gray-900 dark:text-white">Stock: <span>{{ $product->stock }}</span></p>
                    <div class="{{ $product->isActive ? 'bg-lime-100' : 'bg-rose-100' }}  px-2 rounded-md">
                        <p >
                            {{ $product->isActive ? 'Active' : 'Out of stock' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="p-6 text-gray-400 dark:bg-gray-800 dark:border-gray-700">
            <p class="font-semibold text-2xl">No Products available</p>
            <a class="text-blue-600 hover:underline" href="/products">&laquo; Back to all products</a>
        </div> 
        @endforelse
    </div>
    <div class="pb-5">
    {{ $products->links() }}
    </div>
</div>
@endsection