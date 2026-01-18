@extends('dashboard.layouts.sidebar')
@section('container')

<section>
    <div class="flex flex-col md:flex-row gap-2 justify-between">
        <div class="flex gap-1">
            <form action="/dashboard/products" method="get" class="flex gap-1">
                <div class="md:w-96">
                    <div class="flex items-center">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="search" name="search" id="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-primary-500 focus:border-primary-500" placeholder="Search products" autocomplete="off" value="{{ request('search') }}">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row gap-2 relative" x-data="{open:false}">
                    <button x-on:click="open = !open" id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        <p class="capitalize">{{ $category->name ?? 'All' }}</p>
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                    <div x-show="open" x-on:mouseenter="open = true" x-on:mouseleave="open = false" id="actionsDropdown" class="absolute top-10 right-18 z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow" x-cloak>
                        <input type="hidden" name="category" id="filterValue">
                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="actionsDropdownButton">
                            <li>
                                <button type="submit" onclick="document.getElementById('filterValue').value=''" class="w-full text-left py-2 px-4 hover:bg-gray-100">All</button>
                            </li>
                            @foreach($categories as $category)
                            <li>
                                <button type="submit" onclick="document.getElementById('filterValue').value='{{ $category->id }}'" class="w-full text-left py-2 px-4 hover:bg-gray-100">{{ $category->name }}</button>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </form>
        </div>
        <a href="/dashboard/products/create" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-4 py-2">
            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            <p>Add product</p>
        </a>
    </div>

    <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100 my-4">
        <table class="table">
            <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $loop->iteration + ($products->currentPage()-1) * $products->perPage() }}</td>
                <td class="text-nowrap"><a href="/dashboard/products/{{ $product->id }}">{{ $product->name }}</a></td>
                <td class="text-nowrap">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td class="">{{ $product->category->name }}</td>
                <td>
                    <div class="{{ $product->stockStatus()->color }}">
                        <p>{{ $product->stockStatus()->label }}</p>
                    </div>
                </td>
                <td x-data="{open:false}" class="relative">
                    <button x-on:click="open = true" x-on:mouseleave="open = false" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </button>
                    
                    <div x-show="open" x-on:mouseenter="open = true" x-on:mouseleave="open = false" class="absolute z-50 right-1 top-0" x-cloak>
                        <div class="join">
                            <button class="btn join-item bg-white"><a href="/dashboard/products/{{ $product->id }}">Show</a></button>
                            <button class="btn join-item bg-white"><a href="/dashboard/products/{{ $product->id }}/edit">Edit</a></button>
                            <div class="btn join-item bg-white">
                                <form action="/dashboard/products/{{ $product->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td>No products found</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    
    {{ $products->links() }}
    
</section>
@endsection