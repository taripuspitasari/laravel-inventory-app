@extends('dashboard.layouts.sidebar')
@section('container')
<div class="flex flex-col md:flex-row gap-2 justify-between items-end" x-data="{startDate: '{{ request('start_date') }}', endDate: '{{ request('end_date') }}'}">
    <div class="flex gap-1">
        <form action="/dashboard/reports/sales" method="get" class="flex gap-1 items-center">
            <label for="start_date" class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">From Date</span>
                </div>
                <input onchange="this.form.submit()" :value="startDate" name="start_date" id="start_date" type="date" class="input input-bordered w-full max-w-xs"/>
            </label>

            <label for="end_date" class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">To Date</span>
                </div>
                <input onchange="this.form.submit()" :value="endDate" name="end_date" id="end_date" type="date" class="input input-bordered w-full max-w-xs"/>
            </label>
        </form>
    </div>
    <form action="/dashboard/reports/sales-generate" method="get">
        <input type="hidden" name="start_date" :value="startDate">
        <input type="hidden" name="end_date" :value="endDate">
        <div class="py-2.5">
        <button type="submit" class="btn w-full max-w-xs text-white text-xs bg-primary-600 hover:bg-primary-700">Generate Report</button>
    </div>
    </form>
</div>

<div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100 my-4">
        <table class="table">
            <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
            <tr>
                <th><a class="font-normal" href="/dashboard/orders/{{ $order->id }}">{{ $order->order_number }}</a></th>
                <td class="whitespace-nowrap">{{ $order->user->name }}</td>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td class="whitespace-nowrap">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                <td>Paid by {{ $order->payment_method }}</td>
                <td class="capitalize">{{ $order->order_status }}</td>
            </tr>
            @empty
            <tr>
                <td>No orders found</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
@endsection
