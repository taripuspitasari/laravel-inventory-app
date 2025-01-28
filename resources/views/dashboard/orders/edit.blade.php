@extends('dashboard.layouts.sidebar')
@section('container')
<form action="/dashboard/orders/{{ $order->id }}" method="post">
@method('put')
@csrf
<section class="flex flex-col md:flex-row gap-2">
    {{-- main --}}
    <div class="md:w-2/3 space-y-2">
        <div class="bg-white p-4 shadow-md rounded-md flex justify-between items-center">
            <h4 class="font-bold">Order #{{ $order->id }}</h4>
            <ul class="flex gap-2">
                <li>
                    <select id="payment_status" name="payment_status" class="w-full bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="pending" {{ old('payment_status', $order->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ old('payment_status', $order->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ old('payment_status', $order->payment_status) == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </li>
                <li>
                    <select id="order_status" name="order_status" class="w-full bg-gray-50 border text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="pending" {{ old('order_status', $order->order_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processed" {{ old('order_status', $order->order_status) == 'processed' ? 'selected' : '' }}>Processed</option>
                        <option value="shipped" {{ old('order_status', $order->order_status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="completed" {{ old('order_status', $order->order_status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="canceled" {{ old('order_status', $order->order_status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </li>
                <li class="my-auto">{{ $order->created_at->format('Y/m/d') }}</li>
            </ul>
        </div>
        <div class="bg-white p-4 shadow-md rounded-md">
            <h4 class="font-bold">Product Detail</h4>
            <table class="bg-white w-full text-sm text-left">
            @foreach($order->orderDetails as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td class="text-center">{{ $detail->quantity }}</td>
                <td class="text-center">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                <td class="px-5 text-right">Rp. {{number_format(($detail->subtotal), 0, ',', '.')}}</td> 
            </tr> 
            @endforeach
            </table>
        </div>
        <div class="bg-white p-4 shadow-md rounded-md">
            <h4 class="font-bold">Payment Summary</h4>
            <table class="bg-white w-full text-sm text-left">
                <tr>
                    <td>Delivery</td>
                    <td class="px-5 text-right">FREE</td>
                </tr> 
                <tr>
                    <td>Total <span class="text-gray-500">({{ $totalItems }} items)</span></td>
                    <td class="px-5 text-right">Rp. {{number_format(($order->total_amount), 0, ',', '.')}} </td> 
                </tr> 
            </table>
        </div>
    </div>
    {{-- side --}}
    <div class="md:w-1/3 bg-white shadow-md rounded-md p-4 space-y-2">
        <h4 class="font-bold">Customer</h4>
        <div class="border-b pb-1">
            <h5>{{ $order->user->name }}</h5>
        </div>
        <div class="border-b pb-1">
            <h5 class="font-bold">Contact Info</h5>
            <ul>
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                    </svg>
                    <p>{{ $order->user->email }}</p>
                </li>
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.427 14.768 17.2 13.542a1.733 1.733 0 0 0-2.45 0l-.613.613a1.732 1.732 0 0 1-2.45 0l-1.838-1.84a1.735 1.735 0 0 1 0-2.452l.612-.613a1.735 1.735 0 0 0 0-2.452L9.237 5.572a1.6 1.6 0 0 0-2.45 0c-3.223 3.2-1.702 6.896 1.519 10.117 3.22 3.221 6.914 4.745 10.12 1.535a1.601 1.601 0 0 0 0-2.456Z"/>
                    </svg>
                    <p>{{ $order->address->phone_number }}</p>
                </li>
            </ul>
        </div>
        <div class="pb-1">
            <h5 class="font-bold">Shipping Address</h5>
            <ul>
                <li>{{ $order->address->name }}</li>
                <li>{{ $order->address->phone_number }}</li>
                <li>{{ $order->address->address }}</li>
                <li>{{ $order->address->city }}</li>
                <li>{{ $order->address->postal_code }}</li>
            </ul>
        </div>
        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Edit Order</button>
    </div>
</section>
</form>
@endsection