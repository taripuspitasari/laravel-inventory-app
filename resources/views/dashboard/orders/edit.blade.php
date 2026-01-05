@extends('dashboard.layouts.sidebar')
@section('container')
<div class="bg-white shadow-md rounded-md p-4 space-y-2">
    <div>
        <h2 class="text-2xl font-medium">Invoice</h2>
        <div class="overflow-x-auto rounded-md bg-base-100">
            <table>
                <tr>
                    <td class="text-gray-500 w-36">Order ID</td>
                    <td class="w-44 capitalize">{{ $order->id}}</td>
                    <td class="text-gray-500 font-normal text-left w-44">Customer</td>
                    <td class="text-gray-500 font-normal text-left w-44">Shipping To</td>
                </tr>
                <tr>
                    <td class="text-gray-500">Date</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->address->name }}</td>
                </tr>
                <tr>
                    <td class="text-gray-500">Payment Method</td>
                    <td class="capitalize">{{ $order->payment_method}}</td>
                    <td>{{ $order->user->email }}</td>
                    <td>{{ $order->address->phone_number }}</td>
                </tr>
                <tr>
                    <td class="text-gray-500">Status</td>
                    <td class="capitalize">{{ $order->order_status}}</td>
                    <td>{{ $order->address->phone_number }}</td>
                    <td>{{ $order->address->address }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>{{ $order->address->city }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>{{ $order->address->postal_code }}</td>
                </tr>
            </table>
        </div>
    </div>

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
                @foreach ($order->orderDetails as $index => $detail)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="whitespace-nowrap">{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td class="text-right whitespace-nowrap">
                        Rp {{ number_format($detail->price, 0, ',', '.') }}
                    </td>
                    <td class="text-right whitespace-nowrap">
                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Subtotal</td>
                    <td class="text-right whitespace-nowrap">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Delivery</td>
                    <td class="text-right whitespace-nowrap">
                        FREE
                    </td>
                </tr>
                <tr class="bg-gray-200">
                    <td colspan="2"></td>
                    <td colspan="2" class="font-bold">Total</td>
                    <td class="text-right font-bold whitespace-nowrap">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <form action="/dashboard/orders/{{ $order->id }}" method="post" class="flex gap-3 place-items-end justify-end">
    @method('put')
    @csrf
    <label for="order_status" class="form-control w-full max-w-xs">
    <div class="label">
        <span class="label-text">Change order status</span>
    </div>
    <select id="order_status" name="order_status" class="select select-bordered">
        <option value="pending" {{ old('order_status', $order->order_status) == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="processed" {{ old('order_status', $order->order_status) == 'processed' ? 'selected' : '' }}>Processed</option>
        <option value="shipped" {{ old('order_status', $order->order_status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
        <option value="completed" {{ old('order_status', $order->order_status) == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="canceled" {{ old('order_status', $order->order_status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
    </select>
    </label>

    <div>
        <button type="submit" class="btn w-full max-w-xs text-white bg-primary-600 hover:bg-primary-700">Update Order</button>
    </div>
    </form>
</div>
@endsection