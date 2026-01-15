{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inventory Report</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            margin-bottom: 5px;
        }
        .date {
            text-align: center;
            margin-bottom: 20px;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background: #eee;
        }
        .right {
            text-align: right;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Inventory Stock Report</h1>
<div class="date">Generated at: {{ $generatedAt->format('d M Y H:i') }}</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Product</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Total Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $index => $product)
        <tr>
            <td class="center">{{ $index + 1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? '-' }}</td>
            <td class="right">{{ $product->stock }}</td>
            <td class="right">{{ number_format($product->price) }}</td>
            <td class="right">
                {{ number_format($product->stock * $product->price) }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html> --}}


@extends('dashboard.layouts.report')

@section('title', 'Current Stock Report')

@section('content')
<h1>Current Stock Report</h1>
<div class="date">Generated at: {{ $generatedAt->format('d M Y H:i') }}</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Product</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Total Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $index => $product)
        <tr>
            <td class="center">{{ $index + 1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? '-' }}</td>
            <td class="right">{{ $product->stock }}</td>
            <td class="right">{{ number_format($product->price) }}</td>
            <td class="right">
                {{ number_format($product->stock * $product->price) }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

