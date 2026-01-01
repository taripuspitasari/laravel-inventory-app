@extends('dashboard.layouts.sidebar')
@section('container')
<section class="w-full h-full space-y-2">
    <div class="mb-6">
        <div class="overflow-x-auto rounded-md bg-base-100">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <th class="w-40 font-medium text-xs text-gray-900">Name</th>
                        <td>{{ $supplier->name }}</td>
                    </tr>
                    <tr>
                        <th class="w-40 font-medium text-xs text-gray-900">Email</th>
                        <td>{{ $supplier->email }}</td>
                    </tr>
                    <tr>
                        <th class="w-40 font-medium text-xs text-gray-900">Phone</th>
                        <td>{{ $supplier->phone }}</td>
                    </tr>
                    <tr>
                        <th class="w-40 font-medium text-xs text-gray-900">Address</th>
                        <td>{{ $supplier->address }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100 my-4">
        <table class="table">
            <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Invoice</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            @forelse($purchases as $purchase)
            <tr>
                <td>{{ $loop->iteration + ($purchases->currentPage()-1) * $purchases->perPage() }}</td>
                <td class="whitespace-nowrap">{{ $purchase->created_at->format('Y-m-d') }}</td>
                <td><a href="/dashboard/purchases/{{ $purchase->id }}">{{ $purchase->invoice_number }}</a></td>
                <td class="whitespace-nowrap">Rp. {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td>No purchases found</td>
            </tr>
            @endforelse    
            </tbody>
        </table>
    </div>
    {{ $purchases->links() }}
</section>
@endsection