@extends('dashboard.layouts.sidebar')
@section('container')
<div>
  <div class="stats grid shadow rounded-md">
    <div class="stat place-items-center">
      <div class="stat-value">{{ number_format($totalProducts, 0, ',', ',') }}</div>
      <div class="stat-title">Total products</div>
    </div>

    <div class="stat place-items-center">
      <div class="stat-value">{{ number_format($totalOrders, 0, ',', ',') }}</div>
      <div class="stat-title">Orders</div>
    </div>

    <div class="stat place-items-center">
      <div class="stat-value">{{ number_format($totalStock, 0, ',', ',') }}</div>
      <div class="stat-title">Total Stock</div>
    </div>

    <div class="stat place-items-center">
      <div class="stat-value">{{ number_format($totalOutOfStock, 0, ',', ',') }}</div>
      <div class="stat-title">Out of Stock</div>
    </div>
  </div>
</div>


<section class="flex flex-col gap-4 justify-evenly md:flex-row mt-4">
  <div class="flex flex-col justify-center items-center">
    <h3 class="text-2xl font-bold  -mt-2 mb-2">Inventory Values</h3>
    <div class="w-80">
    <canvas id="stockChart"></canvas>
    </div>
  </div>

  <div>
    <h3 class="text-2xl font-bold -mt-2 mb-2 text-center">Top 8 Products by Sales</h3>
    <div class="overflow-x-auto rounded-md border border-base-content/5 bg-base-100 shadow">
      <table class="table table-sm w-full">
        <!-- head -->
        <thead>
          <tr>
            <th>Rank</th>
            <th>Product Name</th>
            <th>Units Sold</th>
          </tr>
        </thead>
        <tbody>
          @foreach($topProducts as $index => $product)
          <tr>
            <th>{{ $index + 1 }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->total_qty_sold }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
  const ctx = document.getElementById('stockChart');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Sold Units", "Total Units"],
      datasets: [{
        backgroundColor: ["#93c5fd", "#1d4ed8"],
        data: @json([$totalSold, $totalStock])
      }]
    },
  });
</script>
@endsection

