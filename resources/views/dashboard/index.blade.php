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


<section class="flex flex-col gap-4 justify-evenly items-start md:flex-row mt-4">
  <div class="flex-1">
    <h3 class="text-2xl font-bold -mt-2 text-center">Top 8 Products by Sales</h3>
    <canvas id="topProductChart"></canvas>
  </div>

  <div class="flex flex-col justify-center items-center">
    <h3 class="text-2xl font-bold -mt-2">Inventory Values</h3>
    <div class="w-80">
    <canvas id="stockChart"></canvas>
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

  const cty = document.getElementById('topProductChart');

  new Chart(cty, {
    type: 'bar',
    data: {
      labels: @json($topProducts->pluck('name')),
      datasets: [{
        backgroundColor: ["#93c5fd", "#1d4ed8"],
        data: @json($topProducts->pluck('total_qty_sold'))
      }]
    },
    options: {
    indexAxis: 'y',
    plugins: {
      legend: { display: false },
    },
  }
  });
</script>
@endsection

