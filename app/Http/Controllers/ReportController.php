<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\ProductService;

class ReportController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function currentStockForm()
    {
        $categories = Category::all();
        return view('dashboard.reports.current-stock-form', [
            'products' => $this->productService->getAllProducts(request(['search', 'category'])),
            'title' => 'Current Stock Report',
            'categories' => $categories,
            'category' => Category::find(request('category'))
        ]);
    }

    public function currentStock()
    {
        $query = Product::with('category');

        if (request('category') != "") {
            $query->where('category_id', request('category'));
        }

        $products = $query->get();

        $pdf = Pdf::loadView('dashboard.reports.current-stock', [
            "products" => $products,
            "generatedAt" => now(),
        ]);

        return $pdf->stream('current-stock-report.pdf');
    }

    public function salesForm()
    {
        $categories = Category::all();

        $query = Order::with('user')->where('order_status', 'completed');

        if (request('start_date')) {
            $query->whereDate('created_at', '>=', request('start_date'));
        }

        if (request('end_date')) {
            $query->whereDate('created_at', '<=', request('end_date'));
        }

        $orders = $query->latest()->simplePaginate(7);
        return view('dashboard.reports.sales-form', [
            'title' => 'Sales Report',
            'categories' => $categories,
            'category' => Category::find(request('category')),
            'orders' => $orders
        ]);
    }

    public function sales()
    {
        $query = Order::with(['orderDetails.product'])->where('order_status', 'completed')->orderBy('created_at', 'desc');

        if (request('start_date')) {
            $query->whereDate('created_at', '>=', request('start_date'));
        }

        if (request('end_date')) {
            $query->whereDate('created_at', '<=', request('end_date'));
        }

        $orders = $query->get();

        $totalSales = $orders->sum('total_amount');
        $totalOrders = $orders->count();
        $totalItems = $orders->sum(fn($order) => $order->orderDetails->sum('quantity'));

        $pdf = Pdf::loadView('dashboard.reports.sales', [
            'orders' => $orders,
            'summary' => [
                'total_sales' => $totalSales,
                'total_orders' => $totalOrders,
                'total_items' => $totalItems,
            ],
            'generatedAt' => now()
        ]);

        return $pdf->stream('sales-report.pdf');
    }
}
