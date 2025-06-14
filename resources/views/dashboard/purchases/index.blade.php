@extends('dashboard.layouts.sidebar')
@section('container')
<section class="">
    <div class="flex flex-col gap-2 md:flex-row justify-between">
        <div class="w-full md:w-96">
            <form action="/dashboard/purchases" method="get" class="flex items-center">
                <label for="search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="search" name="search" value="{{ request('search') }}" id="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search purchases" autocomplete="off" value="{{ request('search') }}">
                </div>
            </form>
        </div>
        <div class="flex gap-2 relative" x-data="{open:false}">
            <a href="/dashboard/purchases/create" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add Purchase
            </a>
        </div>
    </div>

    @if(session()->has('success'))
    <div x-data="{show:true}" x-init="setTimeout(()=> show = false, 5000)" x-show="show" role="alert" class="alert alert-success mt-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current text-white" fill="none" viewBox="0 0 24 24">
            <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-white">{{ session('success') }}</span>
    </div>
    @endif

    @if(session()->has('error'))
    <div x-data="{show:true}" x-init="setTimeout(()=> show = false, 5000)" x-show="show" role="alert" class="flex justify-center md:justify-start alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24"><path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('error') }}</span>
    </div>
    @endif
    
    <div class="bg-white dark:bg-gray-800 relative shadow-md my-4">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr >
                        <th scope="col" class="px-4 py-3">No</th>
                        <th scope="col" class="px-4 py-3">Date</th>
                        <th scope="col" class="px-4 py-3">Invoice</th>
                        <th scope="col" class="px-4 py-3">Amount</th>                       
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $purchase)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-4 py-3">{{ $loop->iteration + ($purchases->currentPage()-1) * $purchases->perPage() }}</td> 
                        <td class="px-4 py-3">{{ $purchase->created_at->format('Y-m-d') }}</td>    
                        <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><a href="/dashboard/purchases/{{ $purchase->id }}">{{ $purchase->invoice_number }}</a></td>                                                    
                        <td class="px-4 py-3 whitespace-nowrap">Rp. {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr class="border-b dark:border-gray-700">
                        <td colspan="5" class="px-4 py-3 text-center">No purchases available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $purchases->links() }}
</section>
@endsection