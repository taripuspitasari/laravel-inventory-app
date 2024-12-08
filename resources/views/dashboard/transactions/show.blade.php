@extends('dashboard.layouts.sidebar')
@section('container')
<div class="bg-white shadow-md rounded-md p-4 space-y-2">
    <div>
        <h2 class="text-xl flex items-center gap-2">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
            </svg>
            <span>Amount</span>
        </h2>
        <section class="flex gap-4 items-center mb-2">
            <p class="text-2xl font-bold">Rp {{ number_format($transaction->totalAmount, 0, ',', '.') }}</p>
        </section>
        <hr>
        <section class="flex flex-col">
            <table>
                <tr>
                    <td class="text-gray-500">Invoice Number</td>
                    <td>{{ $transaction->invoice_number }}</td>
                </tr>
                <tr>
                    <td class="text-gray-500">Transaction Date</td>
                    <td>{{ $transaction->created_at->format('Y/m/d') }}</td>
                </tr>
                <tr>
                    <td class="text-gray-500">Category</td>
                    <td>{{ $transaction->transaction_type == 'in' ? 'Purchase' : 'Sale' }}</td>
                </tr>
                <tr>
                    <td class="text-gray-500">{{ $transaction->transaction_type == 'in' ? 'Vendor' : 'Customer' }}</td>
                    <td>{{ $transaction->partner->name}}</td>
                </tr>
                <tr>
                    <td class="text-gray-500">Description</td>
                    <td>{{ $transaction->notes}}</td>
                </tr>
        </table>
        </section>
    </div>
    <div class="flex items-end gap-2 overflow-x-auto overflow-hidden rounded-lg border border-gray-300">
        <table class="bg-white w-full border-collapse text-sm text-left dark:text-gray-400">
            <thead class="text-sm text-center font-normal text-black dark:bg-gray-700 dark:text-gray-400">
                <tr class="bg-gray-100">
                    <th class="px-4 py-3"></th>
                    <th class="px-4 py-3">Products</th>
                    <th class="px-4 py-3">Qty</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction->transactionDetails as $index => $detail)
                <tr class="border border-gray-300">
                    <td class="px-4 py-3 text-center border border-l-gray-200">{{ $index + 1 }}</td>
                    <td class="border border-gray-300">{{ $detail->product->name }}</td>
                    <td class="text-center border border-gray-300">{{ $detail->quantity }}</td>
                    <td class="border border-gray-300 text-center">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td class="px-5 border border-gray-300 text-right">Rp. {{number_format(($detail->quantity * $detail->price), 0, ',', '.')}}</td> 
                </tr> 
                @endforeach
                <tr class="border border-gray-300 h-8">
                    <td></td>
                    <td colspan="3">Subtotal</td>
                    <td class="text-right px-5">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr class="border border-gray-300 h-8">
                    <td></td>
                    <td colspan="3">Tax 11%</td>
                    <td class="text-right px-5">Rp {{ number_format($tax, 0, ',', '.') }}</td>
                </tr>
                <tr class="border border-gray-300 h-8 bg-gray-200">
                    <td></td>
                    <td colspan="3" class="font-bold">Total</td>
                    <td class="font-bold text-right px-5">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<a href="/dashboard/transactions" class="mt-2 flex items-center justify-center w-12 h-12 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-full text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
    <svg class="w-8 h-8 flex-shrink-0 font-bold" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
    </svg>
</a>
@endsection