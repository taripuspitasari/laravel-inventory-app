@extends('dashboard.layouts.report')
@section('title', 'Sales Report')

@section('content')
<h1>Sales Report</h1>
<div class="date">Generated at: {{ $generatedAt->format('d M Y H:i') }}</div>

<table>
<tr>
    <th>Total Orders</th>
    <th>Total Items Sold</th>
    <th>Total Revenue</th>
</tr>
<tr>
    <td class="center">{{ $summary['total_orders'] }}</td>
    <td class="center">{{ $summary['total_items'] }}</td>
    <td class="right">{{ number_format($summary['total_sales']) }}</td>
</tr>
</table>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Date</th>
    <th>Invoice</th>
    <th>Items</th>
    <th>Total</th>
</tr>
</thead>
<tbody>
@foreach($orders as $i => $order)
<tr>
    <td class="center">{{ $i + 1 }}</td>
    <td>{{ $order->created_at->format('d M Y') }}</td>
    <td>{{ $order->id }}</td>
    <td>
        <ul style="padding-left:12px;">
            @foreach($order->orderDetails as $item)
                <li>
                    {{ $item->product->name }} 
                    ({{ $item->quantity }} x {{ number_format($item->price) }})
                </li>
            @endforeach
        </ul>
    </td>
    <td class="right">{{ number_format($order->total_amount) }}</td>
</tr>
@endforeach
</tbody>
</table>
@endsection