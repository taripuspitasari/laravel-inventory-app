@extends('dashboard.layouts.sidebar')
@section('container')
<section class="">
    <h1 class="font-semibold">{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>
    <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100 my-4">
        <table class="table">
            <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $loop->iteration + ($products->currentPage()-1) * $products->perPage() }}</td>
                <td class="text-nowrap"><a href="/dashboard/products/{{ $product->id }}">{{ $product->name }}</a></td>
                <td class="text-nowrap">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
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
</section>
@endsection