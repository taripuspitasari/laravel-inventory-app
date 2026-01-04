@extends('dashboard.layouts.sidebar')
@section('container')
<div class="bg-white shadow-md rounded-md p-4 space-y-2">
    <div>
        <h2 class="text-2xl font-medium">Invoice</h2>
        <div class="overflow-x-auto rounded-md bg-base-100">
            <table>
                <tr>
                    <td class="text-gray-500 w-40">Invoice Number</td>
                    <td>{{ $purchase->invoice_number }}</td>
                </tr>
                <tr>
                    <td class="text-gray-500">Created By</td>
                    <td>{{ $purchase->user->name }}</td>
                </tr>
                <tr>
                    <td class="text-gray-500">Billed By</td>
                    <td>{{ $purchase->supplier->name}}</td>
                </tr>
                <tr>
                    <td class="text-gray-500">Date Issued</td>
                    <td>{{ $purchase->purchase_date }}</td>
                </tr>
                <tr>
                    <td class="text-gray-500">Description</td>
                    <td>{{ $purchase->notes}}</td>
                </tr>
            </table>
        </div>
    </div>
    {{-- <div class="flex items-end gap-2 overflow-x-auto overflow-hidden rounded-lg border border-gray-300">
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
                @foreach ($purchase->details as $index => $detail)
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
                    <td class="text-right px-5">Rp {{ number_format($purchase->tax, 0, ',', '.') }}</td>
                </tr>
                <tr class="border border-gray-300 h-8 bg-gray-200">
                    <td></td>
                    <td colspan="3" class="font-bold">Total</td>
                    <td class="font-bold text-right px-5">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div> --}}
    <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100 my-4">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th class="text-center w-10">#</th>
                    <th>Item</th>
                    <th class="">QTY</th>
                    <th class="w-32 text-center">Cost</th>
                    <th class="w-32 text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchase->details as $index => $detail)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="whitespace-nowrap">{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td class="text-right whitespace-nowrap">
                        Rp {{ number_format($detail->price, 0, ',', '.') }}
                    </td>
                    <td class="text-right whitespace-nowrap">
                        Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Subtotal</td>
                    <td class="text-right whitespace-nowrap">
                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Tax 11%</td>
                    <td class="text-right whitespace-nowrap">
                        Rp {{ number_format($purchase->tax, 0, ',', '.') }}
                    </td>
                </tr>
                <tr class="bg-gray-200">
                    <td colspan="2"></td>
                    <td colspan="2" class="font-bold">Total</td>
                    <td class="text-right font-bold whitespace-nowrap">
                        Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection