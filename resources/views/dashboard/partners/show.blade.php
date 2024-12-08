@extends('dashboard.layouts.sidebar')
@section('container')
<section class="w-full h-full space-y-2">
    <div class="flex flex-col md:flex-row gap-2">
        <div class="bg-white p-2 shadow-md rounded-md w-full ">
            <h1 class="font-semibold text-lg">{{ $partner->name }}</h1>
            <p class="text-gray-500">{{ $partner->partner_type }}</p>
            <div class="flex justify-between mt-3 gap-5">
                <p class="flex flex-col"><span class="text-gray-500">Phone</span><span>{{ $partner->phone }}</span></p>
                <p class="flex flex-col"><span class="text-gray-500">Email Address</span><span>{{ $partner->email }}</span></p>
            </div>
        </div>
        <div class="bg-white p-2 shadow-md rounded-md w-full">
            <h1 class="font-semibold text-lg">Address</h1>
            <p>{{ $partner->address }}</p>
        </div>
    </div>
    {{-- transactions --}}
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-x-hidden my-4">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr >
                        <th scope="col" class="px-4 py-3">No</th>
                        <th scope="col" class="px-4 py-3">Invoice</th>
                        <th scope="col" class="px-4 py-3">Category</th>
                        <th scope="col" class="px-4 py-3">Amount</th> 
                        <th scope="col" class="px-4 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-4 py-3">{{ $loop->iteration + ($transactions->currentPage()-1) * $transactions->perPage() }}</td>     
                        <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><a href="/dashboard/transactions/{{ $transaction->id }}">{{ $transaction->invoice_number }}</a></td>                                                    
                        <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $transaction->transaction_type == 'in' ? 'Purchase' : 'Sale' }}</td>                         
                        <td class="px-4 py-3">Rp. {{ number_format($transaction->totalAmount, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $transaction->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                    <tr class="border-b dark:border-gray-700">
                        <td colspan="6" class="px-4 py-3 text-center">No transactions found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $transactions->links() }}
    {{-- end transactions --}}
    <a href="javascript:history.back()" class="flex items-center justify-center w-12 h-12 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-full text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
        <svg class="w-8 h-8 flex-shrink-0 font-bold" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
        </svg>
    </a>
</section>
@endsection