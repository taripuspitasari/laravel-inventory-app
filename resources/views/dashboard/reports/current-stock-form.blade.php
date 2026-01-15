@extends('dashboard.layouts.sidebar')
@section('container')
<div class="flex flex-col md:flex-row gap-2 justify-between" x-data="{selectedCategory: '{{ request('category') }}'}">
    <div class="flex gap-1">
        <form action="/dashboard/reports/current-stock" method="get" class="flex gap-1 items-center">
            Current Stock Report by Category: 
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
                    <input type="hidden" name="category" :value="selectedCategory">
                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="actionsDropdownButton">
                        <li>
                            <button type="submit" @click="selectedCategory=''" class="w-full text-left py-2 px-4 hover:bg-gray-100">All</button>
                        </li>
                        @foreach($categories as $category)
                        <li>
                            <button type="submit" class="w-full text-left py-2 px-4 hover:bg-gray-100" @click="selectedCategory={{ $category->id }}" >{{ $category->name }}</button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </form>
    </div>
    <form action="/dashboard/reports/current-stock-generate" method="get" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-4 py-2">
        <input type="hidden" name="category" :value="selectedCategory">
        <button type="submit" >
            <p>Generate Report</p>
        </button>
    </form>
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
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $loop->iteration + ($products->currentPage()-1) * $products->perPage() }}</td>
                <td class="text-nowrap">{{ $product->name }}</td>
                <td class="text-nowrap">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->category->name }}</td>
                <td>
                    <div class="{{ $product->isActive ? 'text-lime-500' : 'text-rose-500' }}">
                        <p>{{ $product->isActive ? 'Active' : 'Out of stock' }}</p>
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
@endsection
